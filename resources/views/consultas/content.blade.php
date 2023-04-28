@extends('welcome')
@section('contentPanel')
    <div class="row">
        @foreach($images as $image)
            <div class="col-xs-6 col-md-3">
                <a href="#" class="thumbnail deleteImage" data-id="{{$image->id}}">
                    <img  src="{{$image->imagesUrl}}"  style="height: 180px; width: 100%; display: block;">
                </a>
            </div>
        @endforeach
    </div>
@endsection
