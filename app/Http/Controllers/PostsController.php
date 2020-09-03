<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB;
use DateTime;

class PostsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // $posts = Post::all(); // Lấy tất cả bản ghi. không sắp xếp.
      $posts = Post::orderBy('created_at', 'desc')->get(); // Lấy tất cả bản ghi. được sắp xếp ngày tạo mới nhất.
      // $posts = DB::select('select * from posts order by created_at asc'); // Lấy tất cả bản ghi theo query thuần.
      return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate( $request, [
        'title' => 'required',
        'description' => 'required',
        'cover_image' => 'image|nullable|max:1999'
      ]);

      // Kiểm tra cover_image trước khi thêm vào Database
      if( $request->hasFile('cover_image') ) {
        // Lấy filename với Extention
        $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
        // Get fileName
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        // Get extention of file
        $extention = $request->file('cover_image')->getClientOriginalExtension();
        // filename
        $fileNameToStore = $fileName . '_' . time() . '.' . $extention;
        // upload image
        $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
      }else {
        $fileNameToStore = 'noimage.jpeg';
      }
      $post = new Post;
      $post->title = $request->input('title');
      $post->body = $request->input('description');
      $post->user_id = auth()->user()->id;
      $post->cover_image = $fileNameToStore;

      $post->save();
      return redirect('/posts')->with('success', 'Tạo thành công bài viết.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $post = Post::find($id);
      if(auth()->user()->id !== $post->user_id) {
        // return view('posts.edit')->with('error', 'Bạn không có quyền truy cập tình năng này.');
        return redirect('/posts')->with('error', 'Bạn không có quyền truy cập tình năng này.');
      }
      return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate( $request, [
        'title' => 'required',
        'description' => 'required'
      ]);

      $post = Post::find($id);

      if(auth()->user()->id !== $post->user_id) {
        // return view('posts.edit')->with('error', 'Bạn không có quyền truy cập tình năng này.');
        return redirect('/posts')->with('error', 'Bạn không có quyền truy cập tình năng này.');
      }

      $post->title = $request->input('title');
      $post->body = $request->input('description');

      $post->save();
      return redirect('/posts')->with('success', 'Đã cập nhật bài viết.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::find($id);
      if(auth()->user()->id !== $post->user_id) {
        return redirect('/posts')->with('error', 'Bạn không có quyền truy cập tình năng này.');
      }
      $post->delete();
      return redirect('/posts')->with('success', 'Bài viết đã được xóa.');
    }
}
