<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
    public function getOffers(){
       return Offer::all();
    }

    public function create(){
        return view('offers.create');
    }

    public function store(Request $request){

        // Validation
        $rules = [
            'name' => 'required:max:100|unique:offers,name',
            'price' => 'required|numeric',
            'details' => 'required',
        ];
        $messages = [
            'name.required' => trans('messages.offer name required'),
            // 'name.required' => __('messages.offer name required'),
            'name.unique' => __('messages.offer name must be unique'),
            'price.required' => __('messages.Offer Price'),
            'price.numeric' => __('messages.Offer price numeric'),
            'details.required' => __('messages.Offer details'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->route('offer-create')->withErrors($validator)->withInput($request->all());
        }

        Offer::create([
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details
        ]);
         $request->session()->flash('success', 'تم اضافة العرض بنجاح');
         return redirect()->route('offer-create');

    }
}
