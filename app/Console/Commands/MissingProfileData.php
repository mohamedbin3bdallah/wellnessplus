<?php

namespace App\Console\Commands;

use App\Instructor;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;


class MissingProfileData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MissingProfileData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email to all tutors who not completed their profile data';

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
     * @return int
     */
    public function handle()
    {

        $this->info('Script Started');

//        $tutors = Instructor::with('user')
//            ->join('users', 'users.id', 'instructors.user_id')
//            ->where(function($q) {
//                $q->where('video', '')
//                    ->orWhere('video', null);
//            })
//            ->where(function($q) {
//                $q->where('users.youtube_url', '')
//                    ->orWhere('users.youtube_url', null);
//            })->get();



//        foreach ($tutors as $tutor){
//            try {
//
//                Mail::to($tutor->email)->send(new \App\Mail\MissingProfileData($tutor));
//
//
//            } catch (\Swift_TransportException $e) {
//
//                //header("refresh:5;url=./login");
//
//                info("failed to send email to tutor with email : ". $tutor->email);
//
//            }
//            info("Success to send email to tutor with email : ". $tutor->email);
//
//        }

        $this->info('Script Ended');


    }
}
