<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    public function create() {
       
        return view('admin.posts.create');
    }
    public function store() {
       
        $attributes = request()->validate([
            'title'=>'required',
            'thumbnail'=>'required|image',
            'slug'=>['required', Rule::unique('posts','slug')],
            'excerpt'=>'required',
            'body'=>'required',
            'category_id'=>['required', Rule::exists('categories', 'id')],
        ]);
        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails', 'public');

        Post::create($attributes);

        return redirect('/');
    }
    
    public function edit($id)
    {
        $post = Post::findOrFail($id);
    
        return view('admin.posts.edit', ['post' => $post]);
    }
   public function update($id)
{
    $post = Post::findOrFail($id);
    $validatedData = request()->validate([
        'title' => 'required',
        'thumbnail' => 'image',
        'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
        'excerpt' => 'required',
        'body' => 'required',
        'category_id' => ['required', Rule::exists('categories', 'id')]
    ]);

    if (isset($validatedData['thumbnail'])) {
        $validatedData['thumbnail'] = request()->file('thumbnail')->store('thumbnails', 'public');
    }

    $validatedData['user_id'] = auth()->user()->id;

    $post->update($validatedData);

    return back()->with('success', 'Post Updated!');
}
public function destroy($id)
{
    $post = Post::findOrFail($id);
    $post->delete();

    return back()->with('success', 'Post Deleted!');
}
    
}
