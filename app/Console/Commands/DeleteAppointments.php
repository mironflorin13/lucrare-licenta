<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\DentistAppointment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:delete_old_appointments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        //
        \Log::info('I was here @ '. Carbon::now()->subMonth(1));
       $appointments=DB::table('dentist_appointments')->where('end_date','<',Carbon::now()->subMonth(1))->delete();
       echo "Appointments delete\n";

    }
}
