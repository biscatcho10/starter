@extends('layouts.app')

@section('content')
    <div class="alert alert-success" id="success_msg" style="display: none;">
        Offer Deleted Succesefully
    </div>
   <div class="container text-white">

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
            <tr class="offerRow{{$offer -> id}}">
                <th scope="row">{{$offer -> id}}</th>
                <td>{{$offer -> name}}</td>
                <td>{{$offer -> price}}</td>
                <td>{{$offer -> details}}</td>
                <td><img style="width: 90px" class="rounded-circle" src="{{asset('images/offers/'.$offer->image)}}"></td>
                <td>
                    <a href="{{route('offer-edit',$offer -> id)}}" class="btn btn-sm  btn-primary"> {{__('messages.update')}}</a>
                    <a href="{{route('offer-delete',$offer -> id)}}" class="btn btn-sm  btn-danger"> {{__('messages.delete')}}</a>
                    <a href="" offer_id="{{$offer -> id}}" class="delete_btn btn btn-sm  btn-outline-danger"> {{__('messages.delAjax')}}</a>
                    <a href="{{route('ajax.offer.edit',$offer -> id)}}" class="btn btn-outline-info btn-sm"> EditAjax</a>
                </td>
            </tr>
        @endforeach
   </div>
@endsection

@section('scripts')
<script>
    $(document).on('click', '.delete_btn', function(e){
            e.preventDefault();
            let offer_id = $(this).attr('offer_id');
            $.ajax({
                type: 'post',
                url: "{{route('ajax.offer.delete')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                        'id': offer_id,
                },
                success: function(data){
                    if(data.status === true){
                        $('#success_msg').show();
                        $('.offerRow'+data.id).remove();
                    }
                },
                error: function(reject){},
            });
        });
</script>

@endsection
