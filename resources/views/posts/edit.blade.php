@extends('layouts.app')

@section('content')


  
  <h1>Edit Post</h1>
  {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST']) !!}

  <div class="form-group">
    {{ Form::label('title', 'Title') }}
    {{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder', 'Title Post'])}}
  </div>
  <div class="form-group">
    {{ Form::label('description', 'Description') }}
    {{ Form::textarea('description', $post->body, ['class' => 'form-control', 'placeholder', 'Description Post'])}}
  </div>
  {{ Form::hidden('_method', 'PUT') }}
  {{ Form::submit('Update Post', ['class' => 'btn btn-primary'])}}

  {!! Form::close() !!}
@endsection
