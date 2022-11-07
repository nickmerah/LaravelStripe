<?php

namespace App\Listeners;

use App\Events\UserUpdatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotifier;

class UserUpdatedListener
{
   
    public function __construct()
    {
         
    }

   
    public function handle(UserUpdatedEvent $event)
    {
        $userinfo = $event->userdetail;
        
        //send mail
        
         $today = date("j/m/Y, H:m");
                
                $details = [  
                        'title'=>'Account Status - MyMessager',
                        'body'=>"Mail sent on $today",
                        'info'=>"Your Account Status for MyMessager is as follows:",
                        'email'=>$userinfo->email,
                        'fullname'=>$userinfo->fullnames,
                        'status'=>$userinfo->isActive
                        ];
             
           //return    Mail::to($dmail)->send(new MailNotifier($details)); 

         //update email_verify_at with timestamp

          DB::table('users')
                  ->where('id', $userinfo->id)
                  ->update(['email_verified_at' => date('Y-m-d H:i:s')]
        );
         
    }
}
