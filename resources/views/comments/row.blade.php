<div class="card mb-2">
    <div class="card-body">
      <div class="card-title d-flex justify-content-between">
        <h6>
        {{ link_to_route('users.show', $comment->author->fullname, $comment->author) }}
        </h6>
      </div>

      <p class="card-text">{{ $comment->comment }}</p>
      <p class="card-text">
        <small class="text-muted">{{ $comment->posted_at }}</small>
      </p>
    </div>
  </div>