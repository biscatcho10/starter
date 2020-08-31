<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class CollectTut extends Controller
{
    public function index(){
        // $numbers = [1,2,2,3];
        // $col = collect($numbers);
        // $result = $col->avg();
        // return $result;


        // $names = collect(['name', 'age']);
        // $result = $names->combine(['karim', '23']);
        // return $result;


        // $ages = collect([1,2,5,8,8,7]);
        // $result = $ages->count();
        // return $result;

        // $ages = collect([1,2,5,8,8,7]);
        // $result = $ages->countBy();
        // return $result;


        $ages = collect([1,2,2,5,8,8,7]);
        $result = $ages->duplicates();
        return $result;
    }

    public function Complex(){
        $offers = Offer::withoutGlobalScopes()->get();

        // Removw
        $offers->each(function($offer){
           if($offer->status == 0){
            unset($offer->image);
            $offer->name_ar = 'hello Ahly';
            $offer->variable = 'hello New';
           }
            return $offer;
        });
        return $offers;

        return $offers ;
    }

    public function complexFilter(){
        $offers = Offer::withoutGlobalScopes()->get();
        $offers = collect($offers);
        $resultOfFilter = $offers->filter(function($value, $key){
                            return $value['status'] == 0;
                        });
        return array_values($resultOfFilter->all() );

    }


    public function complexTransform(){
        $offers = Offer::withoutGlobalScopes()->get();
        $offers = collect($offers);
        $resultOfFilter = $offers->transform(function($value, $key){
                            return 'Name Is : ' .  $value['name_en'];
                        });
        return $resultOfFilter;
    }
}
