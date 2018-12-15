<div class="card-columns">
    @each('posts/postrow', $posts, 'post', 'posts/empty')
</div>

<div class="d-flex justify-content-center">
    {{ $posts->links() }}
</div>
