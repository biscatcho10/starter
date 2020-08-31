<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Hospital;
use App\Models\Service;

class Doctor extends Model
{
    protected $tables = 'doctors';
    protected $fillable = ['name', 'title', 'hospital_id', 'medical_id'];
    protected $hidden = ['created_at', 'updated_at', 'pivot'];

    public function hospital(){
        return $this->belongsTo(Hospital::class);
    }

    public function services(){
        return $this->belongsToMany(Service::class, 'doctor_service');
    }

    // Accessors
    public function getGenderAttribute($val){
        return $val == 1 ? 'male' : 'female';
    }

}
