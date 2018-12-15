@extends('app')

@section('content')
    <p>@lang('posts.show') : {{ link_to_route('posts.show', route('posts.show', $post), $post) }}</p>



    {!! Form::model($post, ['route' => ['posts.update', $post], 'method' =>'PUT']) !!}
        @include('posts/form')

        <div class="pull-left">
            {{ link_to_route('posts.index', __('forms.actions.back'), [], ['class' => 'btn btn-secondary']) }}
            {!! Form::submit(__('forms.actions.update'), ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}

    {!! Form::model($post, ['method' => 'DELETE', 'route' => ['posts.destroy', $post], 'class' => 'form-inline pull-right', 'data-confirm' => __('forms.posts.delete')]) !!}
        {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ' . __('posts.delete'), ['class' => 'btn btn-link text-danger', 'name' => 'submit', 'type' => 'submit']) !!}
    {!! Form::close() !!}
@endsection
