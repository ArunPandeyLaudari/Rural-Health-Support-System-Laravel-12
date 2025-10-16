<?php

namespace App\Models;

use App\Jobs\SendTestMailJob;
use App\Mail\MyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;
// use App\Models\Appointment;


class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id',
        'hospital_id',
        'name',
        'age',
        'phone',
        'address',
        'date',
        'start_time',
        'end_time',
    ];
    public function hospital(){
        return $this->belongsTo(Hospital::class);
    }
    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
    public function patients(){
        return $this->belongsTo(Patient::class);
    }
    protected static function boot()
    {
        parent::boot();
        static::created(function ($appointment) {
            dispatch(new SendTestMailJob($appointment));
        });
    }
}
