<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Policies\TransactionPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\Account;
use App\Models\Budget;
use App\Policies\AccountPolicy;

class AppServiceProvider extends ServiceProvider
{

    protected $policies = [
        Transaction::class => TransactionPolicy::class,
        Account::class => AccountPolicy::class,
        Budget::class => BudgetPolicy::class,
    ];
    
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
    }
}
