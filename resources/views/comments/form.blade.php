@auth
{!! Form::open(['route' => ['comments.store'], 'method' =>'POST']) !!}
<div class="form-group">
    {!! Form::label('comment', __('comments.attributes.comment')) !!}
    {!! Form::textarea('comment', null, ['class' => 'form-control trumbowyg-form' . ($errors->has('comment') ? ' is-invalid' : ''), 'required' => 'required']) !!}

    @if ($errors->has('comment'))
        <span class="invalid-feedback">{{ $errors->first('comment') }}</span>
    @endif
</div>

        <div class="pull-left">
        {!! Form::hidden('post_id', $post->id ) !!}
        {!! Form::hidden('posted_at', now() ) !!}
            {!! Form::submit(__('forms.actions.post'), ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}

   
@else
  @component('alerts.default', ['type' => 'warning'])
    @lang('comments.sign_in_to_comment')
  @endcomponent
@endauth
