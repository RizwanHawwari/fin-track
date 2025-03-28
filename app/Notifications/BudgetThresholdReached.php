<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class BudgetThresholdReached extends Notification
{
    use Queueable;

    protected $budget;

    public function __construct($budget)
    {
        $this->budget = $budget;
    }

    public function via($notifiable)
    {
        return ['database']; // Pastikan pakai 'database'
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Anggaran kategori {$this->budget->category->name} telah melewati batas!",
            'budget_id' => $this->budget->id,
        ];
    }
}
