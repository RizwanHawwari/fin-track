<?php

namespace App\Events;

use App\Models\Budget;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BudgetThresholdReached
{
    use Dispatchable, SerializesModels;

    public $budget;

    public function __construct(Budget $budget)
    {
        $this->budget = $budget;
    }
}
