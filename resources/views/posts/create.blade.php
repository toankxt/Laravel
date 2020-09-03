@extends('layouts.app')

@section('content')
  <h1>Create Post</h1>
  {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

  <div class="form-group">
    {{ Form::label('title', 'Title') }}
    {{ Form::text('title', '', ['class' => 'form-control', 'placeholder', 'Title Post'])}}
  </div>
  <div class="form-group">
    {{ Form::label('description', 'Description') }}
    {{ Form::textarea('description', '', ['class' => 'form-control', 'placeholder', 'Description Post'])}}
  </div>
  <div class="form-group">
    {{ Form::file('cover_image')}}
  </div>

  {{ Form::submit('Create Post', ['class' => 'btn btn-primary'])}}

  {!! Form::close() !!}
@endsection
