@extends('layouts.main')

@section('content')


    <div class="row">
        <div class="sale_main-wr col-md-12">
            <div class="logo_img">
                LOGO
                <img src="/" alt="">
            </div>
            <a href="{{route('new-sale')}}">
            <div class="creact_sale">
                Create a Sale
            </div>
            </a>

        </div>
    </div>
@endsection

