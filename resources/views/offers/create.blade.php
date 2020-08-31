<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Laravel</title>

        <!-- Fonts -->
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,600"
            rel="stylesheet"
        />

        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
            integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
            crossorigin="anonymous"
        />

        <!-- Styles -->
        <style>
            html,
            body {
                background-color: #fff;
                color: #636b6f;
                font-family: "Nunito", sans-serif;
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

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: 0.1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            label{
                float: left;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Starter</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</a>
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
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="mt-5 display-2">
                    {{__('messages.Add you offer')}}
                </div>
                <form action=" {{ route('offer-store') }} " method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                    <label for="ex1">{{__('messages.Offer Name ar')}}</label>
                        <input
                            type="text"
                            name="name_ar"
                            class="form-control @error('name_ar') is-invalid @enderror"
                            id="ex1"
                        />
                        @error('name_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                    <label for="ex1">{{__('messages.Offer Name en')}}</label>
                        <input
                            type="text"
                            name="name_en"
                            class="form-control @error('name_en') is-invalid @enderror"
                            id="ex1"
                        />
                        @error('name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="ex2">{{__('messages.Offer price')}}</label>
                        <input
                            type="text"
                            name="price"
                            class="form-control @error('price') is-invalid @enderror"
                            id="ex2"
                        />
                        @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{__('messages.Offer details ar')}}</label>
                        <textarea
                            name="details_ar"
                            rows="4"
                            class="form-control @error('details_ar') is-invalid @enderror"
                            placeholder="{{__('messages.Offer details ar')}}.."
                        ></textarea>
                        @error('details_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{__('messages.Offer details en')}}</label>
                        <textarea
                            name="details_en"
                            rows="4"
                            class="form-control @error('details_en') is-invalid @enderror"
                            placeholder="{{__('messages.Offer details en')}}.."
                        ></textarea>
                        @error('details_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{__('messages.Offer Image')}}</label>
                        <input
                            type="file"
                            name="image"
                            class="form-control @error('image') is-invalid @enderror"
                        />
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{__('messages.Add Offer')}}
                    </button>
                </form>
            </div>
        </div>
    </body>
</html>
