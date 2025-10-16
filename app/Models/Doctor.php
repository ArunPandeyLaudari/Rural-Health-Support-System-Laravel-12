<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'hospital_id',
        'name',
        'phone',
        'speciality',
        'room',
        'experience',
        'available'
    ];
    public function hospital(){
        return $this->belongsTo(Hospital::class);
    }
    public function appointment(){
        return $this->hasMany(Appointment::class);
    }
    public function patient(){
        return $this->hasMany(Patient::class);
    }

    public static function getDoctorNameById($id)
    {
        $doctor = Doctor::all()->find($id);

        if ($doctor) {
            return $doctor->name;
        }

        return null; // Handle the case when the doctor with the given ID is not found.
    }
}
