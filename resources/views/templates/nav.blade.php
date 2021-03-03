<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-dark text-white border-bottom shadow-sm">
  <p class="h5 my-0 me-md-auto fw-normal ">SkyWork</p>
  @if (Auth::check())   
  <nav class="navbar navbar-dark ">
    <a class="nav-link active " href="home">Home</a>
    @if ( Auth::check() )
    <a class="nav-link active" href="{{ route('profile.index',['username' => Auth::user()->username ]) }}">{{ config('app.name') }}</a>
    <a class="nav-link active" href="{{route('profile.edit')}}">Обновить профиль</a>
    @else
    <a class="nav-link active" href="{{ route('home') }}">{{ config('app.name') }}</a>
    @endif
    <a class="nav-link active" href="{{route('auth.signout')}}">Выйти</a>
  </nav>
  @else
  <a class="nav-link active" href="{{route('auth.signin')}}">Войти</a>
  <a class="btn btn-outline-info" href="{{route('auth.signup')}}">Зарегистрироваться</a>
  @endif
</header>