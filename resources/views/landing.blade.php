@extends('welcome')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card mt-4 pt-4" style="width: 18rem;">
            <img class="card-img-top" src="{{asset('img/log-property.jpg')}}" alt="Card image cap">
            <div class="card-body">
              <a href="{{route('jobs')}}" class="btn btn-primary w-100">View Log jobs</a>
            </div>
          </div>
    </div>
@endsection
