@extends('layouts.app')

@section('content')
  <a href="/posts" class="btn btn-primary mb-5">Go back</a>

  <div class="row">
    <div class="col-md-12">
      <h2>{{ $post->title }}</h2>
      <p>{{ $post->body }}</p>
      <p>Ngày viết: {{ $post->created_at }}</p>
      <p>Tác giả: {{ $post->user_id }}</p>
    </div>
    @if( !Auth::guest() )
      @if( Auth::user()->id == $post->user_id )
        <a href="/posts/{{ $post->id }}/edit" class="btn btn-warning">Sửa bài viết</a>
        {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right ml-2' ]) !!}
          {{ Form::hidden('_method', 'DELETE') }}
          {{ Form::submit('Xóa bài viết', ['class' => 'btn btn-danger']) }}
        {!! Form::close() !!}
      @endif
    @endif


  </div>
@endsection
