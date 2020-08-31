<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $tables = 'countries';
    protected $fillable = ['name',];
    protected $hidden = ['created_at', 'updated_at'];

    public function doctors(){
        return $this->hasManyThrough(Doctor::class, Hospital::class, 'country_id', 'hospital_id');
    }
}
