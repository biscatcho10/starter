@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="alert alert-success" id="success_msg" style="display: none;">
            Offer Save Succesefully
        </div>
        <div class="content mx-auto w-50">
            <div class="mt-5 display-3 my-4 text-center">
                {{__('messages.Add you offer')}}
            </div>
            <form method="POST" id="offerForm" action="" enctype="multipart/form-data">
                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('messages.Offer Name ar')}}</label>
                    <input type="text" class="form-control" name="name_ar"
                           placeholder="{{__('messages.Offer Name')}}">
                    <small id="name_ar_error" class="form-text text-danger" ></small>
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('messages.Offer Name en')}}</label>
                    <input type="text" class="form-control" name="name_en"
                           placeholder="{{__('messages.Offer Name')}}">
                    <small id="name_en_error" class="form-text text-danger" ></small>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('messages.Offer Price')}}</label>
                    <input type="text" class="form-control" name="price"
                           placeholder="{{__('messages.Offer Price')}}">
                    <small id="price_error" class="form-text text-danger" ></small>
                </div>

                <div class="form-group">
                    <label>{{__('messages.Offer details ar')}}</label>
                    <textarea
                        name="details_ar"
                        rows="3"
                        class="form-control"
                        placeholder="{{__('messages.Offer details ar')}}.."
                    ></textarea>
                    <small id="details_ar_error" class="form-text text-danger" ></small>
                </div>

                <div class="form-group">
                    <label>{{__('messages.Offer details en')}}</label>
                    <textarea
                        name="details_en"
                        rows="4"
                        class="form-control"
                        placeholder="{{__('messages.Offer details en')}}.."
                    ></textarea>
                    <small id="details_en_error" class="form-text text-danger" ></small>
                </div>

                <div class="form-group">
                    <label>{{__('messages.Offer Image')}}</label>
                    <input
                        type="file"
                        name="image"
                        class="form-control"
                    />
                    <small id="image_error" class="form-text text-danger" ></small>
                </div>

                <button id="save_offer" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        $(document).on('click', '#save_offer', function(e){
            e.preventDefault();

            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#price_error').text('');
            $('#details_ar_error').text('');
            $('#details_en_error').text('');
            $('#image_error').text('');

            var formData = new FormData($('#offerForm')[0]);

            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('ajax.Offer.store')}}",
                data: formData,
                processData : false,
                contentType : false,
                cache : false,
                success: function(data){
                    if(data.status === true){
                        $('#success_msg').show();
                    }
                },
                error: function (reject) {
                    if( reject.status === 422 ) {
                        var response = $.parseJSON(reject.responseText);
                        $.each(response.errors, function (key, val) {
                            $("#" + key + "_error").text(val[0]);
                        });
                    }
                }
            });
        });

    </script>
@endsection
