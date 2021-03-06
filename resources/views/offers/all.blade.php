<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .error {
            color: #ae1c17;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Starter</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li class="nav-item active">
                    <a class="nav-link"
                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"> {{ $properties['native'] }}
                        <span class="sr-only">(current)</span></a>
                </li>
            @endforeach


        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>




@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{session()->get('success')}}
    </div>
@endif


@if(Session::has('error'))
     <div class="alert alert-danger">
         {{Session::get('error')}}
     </div>
@endif

<a href=" {{ route('offer-create') }} " class="btn btn-primary m-3 float-right">Add Offer</a>

<table class="table table-bordered table-striped w-75 mx-auto mt-5 text-center">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col"> {{__('messages.Offer Name')}} </th>
        <th scope="col">{{__('messages.Offer price')}}</th>
        <th scope="col">{{__('messages.offer Details')}}</th>
        <th scope="col">{{__('messages.Offer Image')}}</th>
        <th scope="col" colspan="2">{{__('messages.operation')}}</th>
    </tr>
    </thead>
    <tbody>


    @foreach($offers as $offer)
        <tr>
            <th scope="row">{{$offer -> id}}</th>
            <td>{{$offer -> name}}</td>
            <td>{{$offer -> price}}</td>
            <td>{{$offer -> details}}</td>
            <td><img style="width: 90px" class="rounded-circle" src="{{asset('images/offers/'.$offer->image)}}"></td>
            <td>
                <a href="{{route('offer-edit',$offer -> id)}}" class="btn btn-primary"> {{__('messages.update')}}</a>
                <a href="{{route('offer-delete',$offer -> id)}}" class="btn btn-danger"> {{__('messages.delete')}}</a>
             </td>
        </tr>
    @endforeach

    </tbody>

</table>
</body>
</html>
