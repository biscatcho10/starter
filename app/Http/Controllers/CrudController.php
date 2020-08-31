<?php

namespace App\Http\Controllers;

use App\Events\videoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use App\Scopes\OfferScope;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CrudController extends Controller
{
    use OfferTrait;

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

         $file_name =$this->saveImage($request->image , 'images/offers');

        Offer::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
            'image' => $file_name,
        ]);
         $request->session()->flash('success', 'تم اضافة العرض بنجاح');
         return redirect()->route('offer-all');

    }

    public function getAllOffers(){
        // $offers = Offer::select(
        //     'id',
        //     'price',
        //     'name_'.LaravelLocalization::getCurrentLocale() . ' as name',
        //     'details_'.LaravelLocalization::getCurrentLocale() . ' as details',
        //     'image'
        //  )->get();
        //  return view('offers.all')->with('offers' , $offers);

        $offers = Offer::select(
            'id',
            'price',
            'name_'.LaravelLocalization::getCurrentLocale() . ' as name',
            'details_'.LaravelLocalization::getCurrentLocale() . ' as details',
            'image'
         )->paginate(PAGINATION_COUNT);
         return view('offers.pagination')->with('offers' , $offers);
     }

     public function editOffer($offer_id){
        $offer =Offer::findOrFail($offer_id);
        if(!$offer){
            return redirect()->back();
        }
        return view('offers.edit')->with('offer', $offer);
     }

     public function updateOffer(OfferRequest $request,$offer_id){
        $offer = Offer::find($offer_id);
        if(!$offer){
            return redirect()->route('offer-all');
        }
        $offer->update($request->all());

        $request->session()->flash('success' , 'Offer Updated Successfully');
        return redirect()->route('offer-all');
     }


     public function getVideo(){
         $video = Video::find(2);
         event(new VideoViewer($video));
         return view('video')->with('video',$video);
     }

     public function deleteOffer($offer_id){
        $offer = Offer::find($offer_id);
        if(!$offer){
            return redirect()->route('offer-all')->with(['error' => __('messages.offer not exist')]);
        }

        $offer->delete();
        return redirect()->route('offer-all', $offer_id)->with(['success' =>  __('messages.offer deleted successfully')]);

     }

     public function getInactiveOffer(){
        //  $offers = Offer::inactive()->get();
        //  $offers = Offer::get();
        $offers = Offer::withoutGlobalScope(OfferScope::class)->get();
         return $offers;
     }

}
