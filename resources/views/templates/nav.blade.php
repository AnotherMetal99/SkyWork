<div class="el1">
    <div class="el1_row">
        <div class="el1_body">
            <ul class="el1_list">

                <li class="el1-item">
                    <a href="/">
                    <br>
                        <h1>SkyWork</h1>
                    </a>
                </li>
                @if ( Auth::check() )
                <form method="GET" action="{{route('search.info')}}" class="form-inline my-2 ml-2 my-lg-0">
                    <input name="query" type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <button type="sibmit" class="btn btn-outline-primary">search</button>
                </form>
                @if ( Auth::check() )
                <li class="el1-item"><a href="{{ route('profile.index',['username' => Auth::user()->username ]) }}">{{config('app.name') }}</a></li>
                <li class="el1-item"><a href="{{route('home')}}">Home</a></li>
                <li class="el1-item"><a href="{{route('friends.index')}}">Friends</a></li>
                <li class="el1-item"><a href="{{route('profile.edit')}}">Обновить профиль</a></li>
                @else
                <li class="el1-item"><a href="{{ route('home') }}">{{ config('app.name') }}</a></li>
                @endif
                <li class="el1-item"><a href="{{route('auth.signout')}}">Выйти</a></li>
                @else
                <li class="el1-item"><a href="{{route('auth.signin')}}">Войти</a></li>
                <li class="el1-item"><a href="{{route('auth.signup')}}">Зарегистрироваться</a></li>
            </ul>
            @endif
        </div>
    </div>
</div>