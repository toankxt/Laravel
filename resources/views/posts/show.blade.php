@extends('layouts.app')

@section('content')
  <a href="/posts" class="btn btn-primary mb-5">Go back</a>

  <div class="row">
    <div class="col-md-8">
      <h2>{{ $post->title }}</h2>
      <p>{{ $post->body }}</p>
      <p>Ngày viết: {{ $post->created_at }}</p>
    </div>
    <div class="col-md-4">
      <a href="/posts/{{ $post->id }}/edit" class="btn btn-warning">Sửa bài viết</a>
      {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right' ]) !!}
        {{ Form::hidden('_method', 'DELETE') }}
        {{ Form::submit('Xóa bài viết', ['class' => 'btn btn-danger']) }}
      {!! Form::close() !!}
    </div>
  </div>

@endsection
