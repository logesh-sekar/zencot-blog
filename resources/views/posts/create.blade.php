@extends('app')

@section('content')
    <h1>@lang('posts.create')</h1>

    {!! Form::open(['route' => ['posts.store'], 'method' =>'POST']) !!}
        @include('posts/form')

        {{ link_to_route('posts.index', __('forms.actions.back'), [], ['class' => 'btn btn-secondary']) }}
        {!! Form::submit(__('forms.actions.save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection
