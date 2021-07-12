<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;



class Doctor extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'slot',
        'photo',
        'service_id'
    ];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function slots(){
        return $this->hasMany(Slot::class);
    }

    public function createManySlots($records){
        foreach($records as $record){
            $this->slots()->create($record);
        }
        return true;
    }





}
