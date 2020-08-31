@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="display-3 w-50 mx-auto my-5">Doctor Services</h3>
        <table class="table table-bordered table-striped w-75 mx-auto my-5 text-center">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Service Name</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($services) && $services->count() > 0)
                    @foreach ($services as $service)
                    <tr>
                        <td>{{$service->id}}</td>
                        <td>{{$service->name}}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <form method="POST" action="{{url('save-services-to-doctor/')}}" class="mt-5">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Select Doctor</label>
                <select class="form-control" name="doctor_id" >
                    @foreach($doctors as $doctor)
                        <option value="{{$doctor -> id}}">{{$doctor -> name}}</option>
                    @endforeach
                </select>

            </div>


            <div class="form-group">
                <label for="exampleInputEmail1">Select Services</label>

                <select class="form-control" name="servicesIds[]" multiple>
                    @foreach($allServices as $allService)
                        <option value="{{$allService -> id}}">{{$allService -> name}}</option>
                    @endforeach
                </select>

            </div>

            <button type="submit" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
        </form>
    </div>
@endsection
