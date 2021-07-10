<?php

namespace App\Observers;

use App\Models\Doctor;
use Illuminate\Support\Facades\Password;
use App\Jobs\resetPassword;

class DoctorObserver
{
    /**
     * Handle the Doctor "created" event.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return void
     */
    public function created(Doctor $doctor)
    {
        // Password::sendResetLink(['email'=>$doctor->email]);
        dispatch(new resetPassword($doctor));

    }




}
