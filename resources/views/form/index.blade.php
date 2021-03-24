@extends('templates.default')

@section('content')
<div class="row">
  <div class="col-lg-5">
    <form method="POST" action="{{route('status.post')}}">
      @csrf
      <div class="form-group">
        <textarea name="status" class="form-control{{$errors->has('status') ? 'is-invalid' : '' }}" placeholder="Что нового?" rows="3"></textarea>
        @if ($errors->has('status'))
        <div class="invalid-feedback">
          {{$errors->first('status')}}
        </div>
        @endif
      </div>
      <button type="submit" class="btn btn-primary">Опубликовать</button>
    </form>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    @if (! $statuses->count() )
    <p>Нет записи!</p>
    @else
    @foreach($statuses as $status)
    <div class="media">
      <div class="mr-3">
        <a href="{{ route('profile.index', ['username' => $status->user->username])}}">
          <img class="media-object rounded" src="{{$status->user->GetImage() }}" alt="{{$status->user->UserName()}}">
        </a>
        <div class="media-body">
          <h4>
            <a href="{{ route('profile.index', ['username' => $status->user->username])}}">{{$status->user->UserName()}}</a>
          </h4>
          <p>{{$status->body}}</p>
          <ul class="list-inline">
            <li class="list-inline-item">{{$status->created_at->diffForHumans()}}</li>
            <li class="list-inline-item">
              <a href=""></a>
            </li>
            <li class="list-inline-item"></li>
          </ul>
           
          @foreach($status->replies as $reply)
              <a href="{{ route('profile.index', ['username' => $reply->user->username])}}">
                <img class="media-object rounded" src="{{$reply->user->GetImage() }}" alt="{{$reply->user->UserName()}}">
              </a>
              <div class="media-body">
                <h4>
                  <a href="{{ route('profile.index', ['username' => $reply->user->username])}}">{{$reply->user->UserName()}}</a>
                </h4>
                <p>{{$reply->body}}</p>
                <ul class="list-inline">
                  <li class="list-inline-item">{{$reply->created_at->diffForHumans()}}</li>
                  <li class="list-inline-item">
                    <a href=""></a>
                  </li>
                  <li class="list-inline-item"></li>
                </ul>
              </div>

            @endforeach

            <form method="POST" action="{{ route('status.out', ['statusId' => $status->id]) }}" class="mb-4">
              @csrf
              <div class="form-group">
                <textarea name="reply-{{$status->id}}" class="form-control{{$errors->has("reply-{$status->id}") ? 'is-invalid' : ''}}" placeholder="Прокомментировать" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-primary btn-sm">Отправить</button>
            </form>

          </div>
        </div>

        @endforeach

        {{$statuses->links()}}
        @endif
      </div>
    </div>
  </div>
  @endsection