@extends('templates.default')
@section('content')


  <div class="sign">
    <form method="post" action="/signin" class="form">
      @csrf
      <h2>Вход в профиль!</h2>
      @if($errors->any())
      <div class="alert alert-danger">
        <ul>@foreach($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <hr>
      <input type="email" class="box" name="email" placeholder="youremail@gmail.com" required="required">
      <input type="password" class="box" name="password" placeholder="Password (min 6)" required="required">
      <input type="submit" value="SIGN IN" id="submit">
      <a href="">Забыль пароль?</a>
    </form>
    <div class="side">
      <img src="images/el2.png" alt="">
    </div>
  </div>

@endsection