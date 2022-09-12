<?php

namespace App\Console\Commands;

use App\Appointment;
use App\Mail\UserAppointment;
use App\Notification;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class appointmentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointmentReminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'appointment reminder before 15 min ';

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

        $appointments = Appointment::with('user', 'instructor', 'meeting')
            ->where('appointments.date', '=', Carbon::today()->format('Y_m_d'))
            ->where('appointments.status_id', "!=",4)
            ->get();

        foreach ($appointments as $appointment) {

            $time_zone = \App\Time_zone::find($appointment->time_zone_id);
            // get slot time format to convert it

            $slot_time = date(" H:i:s", strtotime("$appointment->start_time"));
            // convert from time zone to time zone saved in session
            $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s' , date('Y-m-d'). $slot_time ,  $time_zone->time_zone_name)
                ->setTimezone(session('currentTimeZoneName'));
            $correct_time = \Carbon\Carbon::parse($slot_time_converted)->format('H:i');
//            dd($correct_time);
            $start_time_with_timeZone_min15 = Carbon::createFromFormat('H:i', $correct_time)->subMinutes(15)->format('H:i');
//            dd($appointment->user->timeZone);

            if ($appointment->user->timeZone != null) {
                if ($start_time_with_timeZone_min15 == Carbon::now()->format('H:i')) {

                    try {

                        /*sending email*/
                        $request = $appointment;
                        $meetingid = $appointment->meeting->id;
                        $x = 'Kindly be informed that your lesson with student (' . $request->user->fname . ' ' . $request->user->lname . ') will start in 15 minutes';

                        $y = 'Kindly be informed that your lesson with tutor (' . $request->instructor->user->fname . ' ' . $request->instructor->user->lname . ')  will start in 15 minutes';

                        Mail::to($appointment->user->email)->send(new UserAppointment($y, $request, $meetingid));
                        Mail::to($request->instructor->user->email)->send(new UserAppointment($x, $request, $meetingid));
                        $this->info("mail to : ".$appointment->user->email. ' and '. $request->instructor->user->email." has been sent successfully");


//                    $notification2 = new Notification;
//                    $notification2->type = 6;
//                    $notification2->notifiable_type  = "Instructor" ;
//                    $notification2->notifiable_id  = 1;
//                    $notification2->data  = "You just booked a session";
//                    $notification2->save();

                    } catch (\Swift_TransportException $e) {
                        return 0;
                    }

                }
            }
        }








//        }
        $this->info('Script Ended');

        return true;
    }
}
