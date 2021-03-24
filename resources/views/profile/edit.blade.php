@extends('templates.default')

@section('content')
    
  <div class="sign">
    <form method="post" action="{{route('profile.edit')}}" class="form">
      @csrf
      <h2>Редактирование данных</h2>
      @if($errors->any())
      <div class="alert alert-danger">
        <ul>@foreach($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <hr>
      <input type="first_name" class="box" name="first_name" placeholder="First Name" required="required">
			<input type="last_name" class="box" name="last_name" placeholder="Last Name" required="required">
		  <input type="username" class="box" name="username" placeholder="Username" required="required">
      <input type="email" class="box" name="email" placeholder="Email" required="required">
      <input type="password" class="box" name="password" placeholder="Password (min 6)" required="required">
      <input type="password" class="box" name="confirm_password" placeholder="Confirm Password (min 6)" required="required">
      <button type="submit" value="Create" id="submit">Обновить</button>
    </form>
    <div class="side">
      <img src="images/el3.png" alt="">
    </div>
  </div>

@endsection

