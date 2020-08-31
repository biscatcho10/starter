@extends('layouts.app')

@section('content')
@if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
    <div class="container">
        <h3 class="display-3 w-50 mx-auto my-5">Hospitals Page</h3>
        <table class="table table-bordered table-striped w-75 mx-auto my-5 text-center">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($hospitals) && $hospitals->count() > 0)
                    @foreach ($hospitals as $hops)
                    <tr>
                        <td>{{$hops->id}}</td>
                        <td>{{$hops->name}}</td>
                        <td>{{$hops->address}}</td>
                        <td><a href="{{ route('doctors', $hops->id)}}" class="btn btn-dark">Show Doctors</a></td>
                        <td><a href="{{ route('hospital.delete', $hops->id)}}" class="btn btn-danger">Delete</a></td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
