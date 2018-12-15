<h2 class="mt-2">{{ trans_choice('comments.count', $post->comments_count) }}</h2>


@each('comments/row', $post->comments, 'comment')


@include ('comments/form')