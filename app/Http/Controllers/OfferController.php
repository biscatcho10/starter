<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class OfferController extends Controller
{
    use OfferTrait;

    public function create(){
        return view('ajaxOffer.create');
    }

    public function store(OfferRequest $request){
        // Save offer in db with Ajax
        $file_name =$this->saveImage($request->image , 'images/offers');
        $offer = Offer::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
            'image' => $file_name,
        ]);

        if($offer){
            return response()->json([
                'status' => true,
                'msg' => 'Offer Saved successfully',
            ]);
        }else{
            return response()->json([
                'status' => false,
                'msg' => 'Offer Does Not Saved, Try Again',
            ]);
        }
    }


    public function all(){
         $offers = Offer::select(
                'id',
                'price',
                'name_'.LaravelLocalization::getCurrentLocale() . ' as name',
                'details_'.LaravelLocalization::getCurrentLocale() . ' as details',
                'image'
            )->get();
         return view('ajaxOffer.all')->with('offers' , $offers);
    }

    public function delete(Request $request){
        $offer = Offer::find($request->id);
        if(!$offer){
            return redirect()->route('ajax.offer.all')->with(['error' => __('messages.offer not exist')]);
        }

        $offer->delete();

        return response()->json([
            'status' => true,
            'msg' => "Offer Deletd successfully",
            'id'=> $request->id
        ]);
    }

    public function edit(Request  $request)
    {
         $offer = Offer::find($request ->offer_id );
        if (!$offer)
            return response()->json([
                'status' => false,
                'msg' => 'This Offer Not Exist',
            ]);
        return view('ajaxOffer.edit', compact('offer'));
    }

    public function update(Request $request){
        $offer = Offer::find($request ->offer_id );
        if (!$offer)
        return response()->json([
            'status' => false,
            'msg' => 'This Offer Not Exist',
        ]);

        $offer->update($request->all());
        return response()->json([
            'status' => true,
            'msg' => 'Offer Updated successfully',
        ]);
    }

}
