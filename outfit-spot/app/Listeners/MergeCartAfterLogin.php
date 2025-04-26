<?php

namespace App\Listeners;

use App\Services\CartService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;

class MergeCartAfterLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $cartservice = app(CartService::class);
        $cartservice->mergeCartOnLogin($event->user);
    }
}
