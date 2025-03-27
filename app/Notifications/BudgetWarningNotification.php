<?php

namespace App\Notifications;

use App\Models\Budget;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class BudgetWarningNotification extends Notification
{
    use Queueable;

    protected $budget;

    public function __construct(Budget $budget)
    {
        $this->budget = $budget;
    }

    public function via($notifiable)
    {
        return ['database']; // Hanya simpan di database
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => '⚠️ Budget Hampir Habis!',
            'message' => "Kategori {$this->budget->category->name} hampir melewati batas.",
            'url' => url('/budgets'),
        ];
    }
}
