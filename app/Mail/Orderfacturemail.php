<?php

namespace App\Mail;

use App\User;
use App\Socialmedia;
use App\Contactinf;
use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class Orderfacturemail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = Auth::user();
        //frontend layout variable        
        $socialmedia=Socialmedia::first();
        $contactinf=Contactinf::first();
        $order=Order::where('user_id',$user->id)->latest()->first();
        return $this->view('emails.orderfacture',compact('order','socialmedia','contactinf'));
    }
}
