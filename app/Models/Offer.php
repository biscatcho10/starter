<?php

namespace App\Models;

use App\Scopes\OfferScope;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offers';
    protected $fillable = ['name_ar', 'name_en', 'price','details_ar', 'details_en','image', 'status'];
    protected $hidden = ['created_at', 'updated_at'];

   /////////////////Start Local scopes/////////////////
//    public function scopeInactive($q){
//     return $q->where('status' , '=', '0');
//     }
   /////////////////End Local scopes///////////////////




   /////////////////Start Global Scope//////////////////////
   protected static function boot()
   {
       parent::boot();
       static::addGlobalScope(new OfferScope);
   }
   /////////////////End Global Scope////////////////////////


   // Mutators
   public function setNameEnAttribute($val){
    $this->attributes['name_en'] = strtoupper($val);
   }


}
