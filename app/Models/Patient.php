<?php

namespace App\Models;

use App\Models\Medical;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';
    protected $fillable = ['name', 'age'];
    protected $hidden = ['created_at', 'updated_at'];

    public function doctor(){
        return $this->hasOneThrough(Doctor::class,Medical::class,'patient_id','medical_id');
    }
}
