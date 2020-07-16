<?php

namespace App\Console\Commands;

use App\Mail\NotifyEmail;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email Notify For All users Every Day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $emails = User::select('email')->get(); // select all user's emails as a Collection (بجيب كل الاكونات بتاعت المستخدمين)
        $emails = User::pluck('email')->toArray(); // ( بجيب كل الاكونات بتاعت المستخدمين علي شكل اريي)
        $data = ['title' => 'Programming', 'body' => 'php' ];
        foreach($emails as $email ){
            // how to send emails in laravel
            Mail::To($email)->send(new NotifyEmail($data));
        }
    }
}
