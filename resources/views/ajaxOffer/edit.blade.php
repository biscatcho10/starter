@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="alert alert-success" id="success_msg" style="display: none;">
            The offer Updated Successfully
        </div>

        <div class="content">
            <div class="title display-4 my-3 mx-auto w-50">
                {{__('messages.Update your offer')}}
            </div>
            <br>
            <form method="POST"  id="offerFormUpdate" action="" enctype="multipart/form-data" class="w-50 mx-auto my-3">
                @csrf

                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('messages.Offer Name ar')}}</label>
                    <input type="text" class="form-control" value="{{$offer -> name_ar}}" name="name_ar"
                           placeholder="{{__('messages.Offer Name')}}">
                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <input type="text" style="display: none;" class="form-control" value="{{$offer -> id}}" name="offer_id">

                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('messages.Offer Name en')}}</label>
                    <input type="text" class="form-control" value="{{$offer -> name_en}}" name="name_en"
                           placeholder="{{__('messages.Offer Name')}}">
                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('messages.Offer Price')}}</label>
                    <input type="text" class="form-control" value="{{$offer -> price}}" name="price"
                           placeholder="{{__('messages.Offer Price')}}">
                    @error('price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('messages.Offer details ar')}}</label>
                    <textarea name="details_ar" rows="3" class="form-control">{{$offer -> details_ar}}</textarea>
                    @error('details_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">{{__('messages.Offer details en')}}</label>
                    <textarea name="details_en" rows="3" class="form-control">{{$offer -> details_en}}</textarea>
                    @error('details_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __("messages.Offer Image")}}</label>
                    <input type="file" id="file" class="form-control" name="image">
                    <img src=" {{asset('images/offers/'.$offer->image)}}" style="width: 90px;" class="img-fluid round">
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <input type="hidden" name="offer_id" value="{{ $offer->id}}">

                <button id="update_offer" class="btn btn-primary float-right w-25">{{__('messages.Save Offer')}}</button>
            </form>
        </div>


    </div>
@endsection

@section('scripts')
    <script>

        $(document).on('click', '#update_offer', function (e) {
            e.preventDefault();

            var formData = new FormData($('#offerFormUpdate')[0]);

            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('ajax.offer.update')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {

                    if(data.status == true){
                        $('#success_msg').show();
                    }


                }, error: function (reject) {
                }
            });
        });


    </script>
@endsection

