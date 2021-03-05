@extends('templates.default')

@section('content')
  <div class="row">
     <div class="col-lg-5">
       @include('search.usersearch')
     </div>

     <div class="col-lg-4 col-lg-offset-3">
       <h4>{{ $user->username }} друзья</h4>

       @if (!$user->friends()->count())
         <p>{{ $user->username }} нет друзей</p>
       @else 
         @foreach($user->friends() as $user)
           @include('search.usersearch')
         @endforeach
       @endif
     </div>
  </div>

@endsection
