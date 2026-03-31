<?php

namespace App\Http\Controllers;

use App\Events\DislikePostEvent;
use App\Events\DropCommentEvent;
use App\Events\LikePostEvent;
use App\Events\NewPostEvent;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\DropCommentRequest;
use App\Http\Resources\CommunityChatCommentResource;
use App\Http\Resources\CommunityChatResource;
use App\Models\CommunityChat;
use App\Models\CommunityChatComment;
use App\Models\CommunityChatReaction;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommunityController extends Controller
{
    use ApiResponse;

    public function allPosts()
    {
        if (auth()->user()->application_name == "cue" || auth()->user()->application_name == "cueDriver") {
            $posts = CommunityChat::where('application_name', 'cue')->orWhere('application_name', 'cueDriver')->orderBy('created_at', 'DESC')->get();
        } else {
            $posts = CommunityChat::where('application_name', 'flip')->orderBy('created_at', 'DESC')->get();
        }
        $postResource = CommunityChatResource::collection($posts);
        $meta = [
            'postCount' => count($posts),
        ];
        return ApiResponse::successResponseWithMetadata($postResource, $meta, "All Posts retrived", Response::HTTP_OK);
    }

    public function postsByMe()
    {
        $posts = CommunityChat::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        $postResource = CommunityChatResource::collection($posts);
        $meta = [
            'postCount' => count($posts),
        ];
        return ApiResponse::successResponseWithMetadata($postResource, $meta, "My Posts retrived", Response::HTTP_OK);
    }

    public function createPost(CreatePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['application_name'] = auth()->user()->application_name;

        if ($request->has('image')) {
            $data['image'] = pushFileStringToStorage($data['image'], 'community');
        }

        $post = CommunityChat::create($data);

        //Dispatch the new post event
        event(new NewPostEvent($post));

        $postResource = new CommunityChatResource($post);
        return ApiResponse::successResponseWithData($postResource, "Message Sent", Response::HTTP_CREATED);
    }

    public function singlePost(CommunityChat $post)
    {
        $postResource = new CommunityChatResource($post);
        return ApiResponse::successResponseWithData($postResource, "Post details retrieved", Response::HTTP_OK);
    }

    public function deletePost(CommunityChat $post)
    {
        if ($post->user_id != auth()->user()->id) {
            return ApiResponse::errorResponse("Cannot delete the post of other users", Response::HTTP_BAD_REQUEST);
        }
        CommunityChatReaction::where('post_id', $post->id)->delete();
        CommunityChatComment::where('post_id', $post->id)->delete();
        $post->delete();
        return ApiResponse::successResponse("Post removed Successfully", Response::HTTP_OK);
    }

    public function likePost(CommunityChat $post)
    {
        $reaction = CommunityChatReaction::where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();
        if ($reaction) {
            if ($reaction->reaction == "like") {
                return ApiResponse::errorResponse("Already liked this Post", Response::HTTP_CONFLICT);
            }
            if ($reaction->reaction == "dislike") {
                $post->dislikes = $post['dislikes'] - 1;
            }
            $reaction->update(['reaction' => "like"]);
        } else {
            CommunityChatReaction::create([
                'post_id' => $post->id,
                'user_id' => auth()->user()->id,
                'reaction' => "like"
            ]);
        }

        $post->likes = $post['likes'] + 1;
        $post->save();

        //Dispatch an event
        event(new LikePostEvent($post));

        $postResource = new CommunityChatResource($post);
        return ApiResponse::successResponseWithData($postResource, "Post was Liked", Response::HTTP_OK);
    }

    public function unLikePost(CommunityChat $post)
    {
        $reaction = CommunityChatReaction::where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();
        if (!$reaction && $reaction->reaction != 'like') {
            return ApiResponse::errorResponse("Only liked post can be unliked", Response::HTTP_CONFLICT);
        }
        $reaction->update(['reaction' => 'unlike']);

        $post->likes = $post['likes'] - 1;
        $post->save();
        return ApiResponse::successResponseWithData(new CommunityChatResource($post), "Post was Unliked", Response::HTTP_OK);
    }

    public function disLikePost(CommunityChat $post)
    {
        $reaction = CommunityChatReaction::where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();
        if ($reaction) {
            if ($reaction->reaction == "dislike") {
                return ApiResponse::errorResponse("Already disliked this Post", Response::HTTP_CONFLICT);
            }
            if ($reaction->reaction == "like") {
                $post->likes = $post['likes'] - 1;
            }
            $reaction->update(['reaction' => "dislike"]);
        } else {
            CommunityChatReaction::create([
                'post_id' => $post->id,
                'user_id' => auth()->user()->id,
                'reaction' => "dislike"
            ]);
        }
        $post->dislikes = $post['dislikes'] + 1;
        $post->save();

        //Dispatch an event
        event(new DislikePostEvent($post));

        $postResource = new CommunityChatResource($post);
        return ApiResponse::successResponseWithData($postResource, "Post was Disliked", Response::HTTP_OK);
    }

    public function reactionToPost(CommunityChat $post)
    {
        $reaction = CommunityChatReaction::where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();
        abort_if(!$reaction, ApiResponse::errorResponse("Post reaction not found"), Response::HTTP_NOT_FOUND);
        $data = [
            'id' => $reaction->id,
            'reaction' => $reaction->reaction,
            'date' => $reaction->updated_at
        ];
        return ApiResponse::successResponseWithData($data, "My response to post", Response::HTTP_OK);
    }

    public function comment(CommunityChat $post, DropCommentRequest $request)
    {
        $data = $request->validated();
        $data['post_id'] = $post->id;
        $data['user_id'] = auth()->user()->id;

        if ($request->has('image')) {
            $data['image'] = pushFileStringToStorage($data['image'], 'community');
        }
        $comment = CommunityChatComment::create($data);

        //Dispatch an event
        event(new DropCommentEvent($comment));

        return ApiResponse::successResponseWithData(new CommunityChatCommentResource($comment), "New comment posted", Response::HTTP_CREATED);
    }

    public function removeComment(CommunityChatComment $comment)
    {
        if ($comment->user_id != auth()->user()->id) {
            return ApiResponse::errorResponse("Cannot delete the comment of other users", Response::HTTP_BAD_REQUEST);
        }
        $comment->delete();
        return ApiResponse::successResponse("Comment was removed successfully", Response::HTTP_OK);
    }
}
