@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-con 345t2ent-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Bài viết của bạn</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if( count($posts) > 0 )
                      <table class="table mt-3">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Ảnh Thumbnail</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach( $posts as $post )
                            <tr>
                              <th scope="row">{{ $post->id }}</th>
                              <td>{{ $post->title }}</td>
                              <td>
                                <img width="40px" height="40px" src="/storage/cover_images/{{$post->cover_image}}" alt="">
                              </td>
                              <td>
                                <a href="/posts/{{ $post->id}}/edit" class="btn btn-warning">Sửa bài viết</a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    @else
                      <div class="alert alert-warning">
                        Bạn chưa có bài viết nào!
                      </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
