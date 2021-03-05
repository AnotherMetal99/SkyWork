<div class="media mb-2">
  <a href="{{ route('profile.index', ['username' => $user->username ]) }}">
    <img src="{{ $user->GetImage() }}" class="mr-3" alt="{{ $user->username}}">
  </a>
  <div class="media-body">
  <h3 class="mt-0">
  <a href="{{ route('profile.index', ['username' => $user->username ]) }}">{{ $user->username}}</a>
  </h3>
  </div>
</div>