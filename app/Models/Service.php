<?php

namespace App\Models;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $tables = 'services';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at', 'pivot'];

    public function doctors(){
        return $this->belongsToMany(Doctor::class, 'doctor_service');
    }
}
