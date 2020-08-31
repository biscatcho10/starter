@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="display-3 w-50 mx-auto my-5">Doctors Page</h3>
        <table class="table table-bordered table-striped w-75 mx-auto my-5 text-center">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Title</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($doctors) && $doctors->count() > 0)
                    @foreach ($doctors as $doc)
                    <tr>
                        <td>{{$doc->id}}</td>
                        <td>{{$doc->name}}</td>
                        <td>{{$doc->title}}</td>
                        <td><a href=" {{route('get.doctor.service', $doc->id)}} " class="btn btn-primary">Show Services</a></td>
                        <td><a href="" class="btn btn-danger">Delete</a></td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
