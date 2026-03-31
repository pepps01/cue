<?php

return [
    'vehicle' => [
        'status' => [
            'economy' => 'economy',
            'business' => 'business',
            'luxury' => 'luxury'
        ]
    ],
    'wallet' => [
        "top" => [
            'title' => "Wallet Deposit",
            'message' => "Wallet deposit was completed successfully and balance updated",
        ],
        "request" => [
            'title' => "Request Wallet Withdrawal",
            'message' => "Wallet withdrawal has been initiated",
        ],
        "performance" => [
            'title' => "Performance Reward",
            'message' => "Congratulations, you have been awarded a bonus amount of " . env('DRIVER_PERFORMANCE_REWARD') . "for completing " . env('DRIVER_PERFORMANCE_NO_RIDES') . " rides on Cue"
        ]
    ],
    'order' => [
        'initiate' => [
            'title' => "New Order Request",
            'message' => "A new Order has been successfully created",
        ],
        'accept' => [
            'title' => "Order Accepted",
            'message' => "Order has been accepted successfully",
        ],
        'reject' => [
            'title' => "Order Rejected",
            'message' => "Order has been rejected unfortunately",
        ],
    ],
    'proposal' => [
        'create' => [
            'title' => "Proposal Submitted",
            'message' => "A new proposal has been submitted for a Job application"
        ],
        'update' => [
            'title' => "Proposal Updated",
            'message' => "Proposal was updated successfully"
        ],
        'removed' => [
            'title' => "Proposal Withdrawal",
            'message' => "Proposal withdrawal was completed successfully"
        ],
        'accept' => [
            'title' => "Proposal Accepted",
            'message' => "Proposal request has been accepted successfully"
        ],
        'review' => [
            'title' => "Review Requested on Proposal",
            'message' => "A review on proposal has been requested successfully"
        ],
        'reject' => [
            'title' => "Proposal Rejected",
            'message' => "Proposal request has been rejected unfortunately"
        ]
    ],
    'trip' => [
        'request' => [
            'title' => "New Trip Requested",
            'message' => "A rider near you has requested a new trip. Proceed to accept the Ride request"
        ],
        'rider_cancel' => [
            'title' => "Trip Canceled",
            'message' => "Unfortunately, this trip cannot proceed further, because it was canceled by the Rider"
        ],
        'driver_cancel' => [
            'title' => "Trip Canceled",
            'message' => "Unfortunately, this trip cannot proceed further, because it was canceled by the Driver"
        ],
        'driver_accepted' => [
            'title' => "Trip Accepted",
            'message' => "Your trip request has been accepted, your driver is on the way to pick you up"
        ],
        'driver_arrived' => [
            'title' => "Driver Arrived PickUp",
            'message' => "Your driver has arrived"
        ],
        'paid' => [
            'title' => "Payment Completed",
            'message' => "Bag secured, payment for your successfull trip has been completed by the rider"
        ],
        'complete' => [
            'title' => "Trip Completed",
            'message' => "Congratulations, you have arrived at your destination"
        ]
    ],
    'fcm_secret' => 'AAAADO8205k:APA91bHioHMBXQWwILZp17dH3FjYutOJWxKuveIbqZiVes0oX19cWJbqK4UZ5ayGPU7g4eFJBel4Po5QFN8xBjsPYzzlLZwxuJWy7DmTfPhkt4DW8SReyvTyqYd8TeRplYwShJM6GyA9'
];
