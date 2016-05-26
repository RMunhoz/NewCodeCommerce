<?php

namespace CodeCommerce\Listeners;

use Illuminate\Support\Facades\Mail;
use CodeCommerce\Events\CheckoutEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailCheckout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CheckoutEvent  $event
     * @return void
     */
    public function handle(CheckoutEvent $event)
    {
        
        Mail::send('emails.contact', ['event' => $event], function($message) use ($event) {
            $message->from('rogerio_munhoz@hotmail.com.br', 'CodeCommerce');
            $message->to($event->getUser()->email, $event->getUser()->name);
        });

    }
}
