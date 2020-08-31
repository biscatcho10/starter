<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Phone;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    public function hasOneRelation() {
        $user = User::with(['phone' => function($q){
            $q -> select('code', 'phone', 'user_id');
        }] )->find(1);
        // $phone = $user->phone;
        // $code = $user->phone->code;
        return response()->json($user);
    }

    public function hasOneRelationReverse(){
        $phone = Phone::find(1);
        // make some hidden attribute Visible
        $phone->makeVisible(['user_id']);
        // make some Visible attribute hidden
        $phone->makeHidden(['created_at', 'updated_at']);
        return response()->json($phone);
    }

    public function getUserHasPhone(){
        $user = User::whereHas('phone')->get();
        return response()->json($user);
    }
    public function getUserHasPhoneWithCondition(){
        $user = User::whereHas('phone', function($q){
            $q -> where('code', '02');
        })->get();
        return response()->json($user);
    }

    public function getUserHasNotPhone(){
        $user = User::whereDoesntHave('phone')->get();
        return response()->json($user);
    }

///////////////////////one to many Methods////////////////////////
    public function getHospDoctors(){
        // $hospital = Hospital::with('doctors')->find(1);
        // $doctors = $hospital->doctors;

        // foreach($doctors as $doctor){
        //     echo $doctor->name . '<br>';
        // }

        $doctor = Doctor::find(3);
        $hospital = $doctor->hospital->name;
        return $hospital;
    }

    public function hospitals(){
        $hospitals = Hospital::all();
        return view('doctors.hopitals')->with('hospitals' , $hospitals);
    }

    public function doctors($hospital_id){
        $hospitals = Hospital::find($hospital_id);
        $doctors = $hospitals->doctors;
        return view('doctors.doctors')->with('doctors' , $doctors);
    }

    public function hospitalsHasDoctors(){
        $hospitals = Hospital::whereHas('doctors')->get();
        return response()->json($hospitals);
    }

    public function hospitalsHasMaleDoctors(){
        $hospitals = Hospital::whereHas('doctors', function($q){
            $q -> where('gender' , 'male');
        })->get();
        return response()->json($hospitals);
    }

    public function hospitalsHasNoDoctors(){
        $hospitals = Hospital::whereDoesntHave('doctors')->get();
        return response()->json($hospitals);
    }

    public function deleteHospital($hospital_id, Request $request){
        $hospital = Hospital::find($hospital_id);
        if(! $hospital){
            return abort('$404');
        }else{
            $hospital->doctors()->delete();
            $hospital->delete();
            $request->session()->flash('success', 'Hospital Deleted Successfully');
            return redirect()->route('hospital.all');
        }
    }

    public function getDoctorServices(){
        $doctor = Doctor::first();
        $services = $doctor->services;
        return response()->json($services);
    }

    public function getServiceDoctors(){
        $service = Service::with(['doctors'=> function($q){
            $q-> select( 'name','title');
        }])->find(1);
        // $doctors = $service->doctors;
        return response()->json($service);
    }

    public function getDoctorServiceByTd($doctor_id){
        $doctor = Doctor::find($doctor_id);
        $services = $doctor->services;
        return view('doctors.services', ['services' => $services, 'doctors' => Doctor::all(), 'allServices' => Service::all() ]);
    }

    public function saveServiceToDoctor(Request $request){
        $doctor = Doctor::find($request->doctor_id);
        if(! $doctor){
            return abort('404');
        }
        // $doctor->services()->attach($request->servicesIds); // save the new data (Data itertion)
        // $doctor->services()->sync($request->servicesIds); // delete old data save the new data only
        $doctor->services()->syncWithoutDetaching($request->servicesIds); // append new data to the old data (save both without iteration)
        return redirect()->back();
    }

    public function getPatientDoctor(){
        $patient = Patient::find(1);
        $doctor = $patient->doctor;
        return $doctor;
    }

    public function getCountryDoctor(){
        $country = Country::find(1);
        $doctors = $country->doctors;
        return $doctors;
    }

    public function getDoctors(){
        $doctors =Doctor::select('id', 'name', 'gender')->get();
        return $doctors;
    }

}
