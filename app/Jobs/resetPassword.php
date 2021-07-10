<?php

namespace App\Jobs;

use App\Models\Doctor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Password;

class resetPassword implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $doctor;
    public function __construct(Doctor $doctor)
    {
        $this->doctor = $doctor;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Password::sendResetLink(['email'=>$this->doctor->email]);
    }
}
