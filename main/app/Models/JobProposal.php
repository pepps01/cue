<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobProposal extends Model
{
    use HasFactory, Uuids;

    protected $guarded = ['id'];

    public function job()
    {
        return $this->belongsTo(JobPosting::class);
    }

    public function milestones()
    {
        return $this->hasMany(JobProposalMilestone::class, 'proposal_id');
    }

}
