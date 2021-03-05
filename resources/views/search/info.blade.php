@extends('templates.default')

@section('content')
<div class="row">
  <div class="col-lg-6">
    <h1>Результат поиска: {{Request::input('query')}}</h1>

    @if(!$users->count())
      <p>Не найден</p>
    @else
      <div class="row">
        <div class="col-lg-6">
          @foreach ($users as $user)
            @include('search.usersearch')
          @endforeach
         </div>
      </div>
    @endif
  </div>
</div>
@endsection