<?php

namespace App\Console\Commands;

use App\Appointment;
use App\Cart;
use Illuminate\Console\Command;

class cancelNonPaymentAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cancelNonPaymentAppointments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel Not Paid Appointment and mark it as free';

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

        $appointmentsRecords = Appointment::where('status_id', 7)
                                ->where(function($q) {
                                    $q->where('payment_transaction_id', 0)
                                        ->orWhere('payment_transaction_id', null);
                                })->get();

        foreach ($appointmentsRecords as $appointmentsRecord){

            $record = Appointment::find($appointmentsRecord->id);
            $record->delete();

            $record = Cart::where('appointment_id', $appointmentsRecord->id);
            $record->delete();

            $this->info("Apintment with ID# : ".$appointmentsRecord->id." has been deleted successfully");

        }

        $this->info('Script Ended');

    }
}
