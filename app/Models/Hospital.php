<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $fillable = [
        'hospital_name',
        'phone',
        'address',
        'since',
        'bond_of'
    ];
    public function doctor(){
        return $this->hasMany(Doctor::class);
    }
    public function appointment(){
        return $this->hasMany(Doctor::class);
    }
}
