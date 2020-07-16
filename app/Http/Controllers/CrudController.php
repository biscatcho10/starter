<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CrudController extends Controller
{
    public function getOffers(){
       return Offer::all();
    }

    public function create(){
        return view('offers.create');
    }

    public function store(OfferRequest $request){

        // Validation
        /*
          $rules = [
            'name' => 'required:max:100|unique:offers,name',
            'price' => 'required|numeric',
            'details' => 'required',
        ];
        $messages = [
            'name.required' => trans('messages.offer name required'),
            // 'name.required' => __('messages.offer name required'),
            'name.unique' => __('messages.offer name must be unique'),
            'price.required' => __('messages.Offer Price required'),
            'price.numeric' => __('messages.Offer price numeric'),
            'details.required' => __('messages.Offer details required'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->route('offer-create')->withErrors($validator)->withInput($request->all());
        }
         */

        Offer::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
        ]);
         $request->session()->flash('success', 'تم اضافة العرض بنجاح');
         return redirect()->route('offer-create');

    }

    public function getAllOffers(){
        $offers = Offer::select(
            'id',
            'price',
            'name_'.LaravelLocalization::getCurrentLocale() . ' as name',
            'details_'.LaravelLocalization::getCurrentLocale() . ' as details',
         )->get();
         return view('offers.all')->with('offers' , $offers);
     }


}
