<div class="card mb-2">


  <div class="card-body">
    <h4 v-pre class="card-title">
      {{ link_to_route('posts.show', $post->title, $post) }}
    </h4>

    <p class="card-text">
      <small class="text-muted">{{ $post->posted_at }}</small><br>
      <small class="text-muted">
        <i class="fa fa-comments-o" aria-hidden="true"></i> {{ $post->comments_count }}
      </small>
    </p>
  </div>
</div>
