@extends('layouts.app')

@section('content')
  <h1>Tất cả bài viết</h1>


  @if( count($posts) > 1 )
    <div class="row">
      @foreach( $posts as $post )
        <div class="col-sm-3 mt-3">
          <div class="card">
            <img class="card-img-top" src="/storage/cover_images/{{ $post->cover_image }}" alt="{{ $post->cover_image }}">
            <div class="card-body">
              <h5 class="card-title">{{ $post->title }}</h5>
              <small>Ngày viết {{ $post->created_at }}</small>
              <p class="card-text">{{ Str::of($post->body)->limit(20) }}</p>
              <a href="/posts/{{ $post->id }}" class="btn btn-primary">Xem chi tiết</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>






  {{-- <div class="card">
    <ul class="list-group list-group-flush">
      @foreach( $posts as $post )
        <li class="list-group-item">
          <h3><a href="posts/{{ $post->id }}">{{ $post->title }}</a></h3>
          <small>Ngày viết {{ $post->created_at }}</small>
        </li>
      @endforeach
    </ul>
  </div> --}}

  @else


  @endif

@endsection
