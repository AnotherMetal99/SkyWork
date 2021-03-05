@extends('templates.default')

@section('content')
  <div class="row">
     <div class="col-lg-5">
       <h3>Друзья:</h3>
       @if (!$friends->count())
         <p> нет друзей</p>
       @else 
         @foreach($friends as $user)
           @include('search.usersearch')
         @endforeach
       @endif
     </div>

     <div class="col-lg-5">
       <h3>Запросы в друзья:</h3>
       @if (!$requests->count())
         <p> нет запросов</p>
       @else 
         @foreach($requests as $user)
           @include('search.usersearch')
         @endforeach
       @endif
     </div>
  </div>

@endsection
