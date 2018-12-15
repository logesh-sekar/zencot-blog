@extends('app')

@section('content')
  <div class="bg-white p-3 post-card">
<br><br>

    <h1 v-pre>{{ $post->title }}</h1>

    <div class="mb-3">
      <small v-pre class="text-muted">{{ link_to_route('users.show', $post->author->fullname, $post->author) }}</small>,
      <small class="text-muted">{{ $post->posted_at }}</small>
    </div>

    <div v-pre class="post-content">
      {!! $post->content !!}
    </div>


  </div>

  @include ('comments/list')
@endsection
