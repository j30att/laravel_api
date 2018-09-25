@extends($_typeDevice.'.layouts.main')

@section('content')


    <div class="row">
        <div class="personal_inform col-md-12">
            <div class="personal_inform__title ">
                <a href="{{route('signin')}}"><div class="goback"></div></a>
                Home
            </div>
            <div>
                What is Lorem Ipsum?
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.What is Lorem Ipsum?
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </div>
            <div class="private_policy">
                By creating an account you agree to our
                <a href="{{route('terms')}}">Terms & Conditions</a> and  <a href="{{route('privacy')}}">Privacy Policy</a>
            </div>
        </div>
    </div>
@endsection


