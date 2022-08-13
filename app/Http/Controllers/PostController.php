<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Space;

class PostController extends Controller
{
    public function create(Space $space)
    {
        $this->authorize('addPost', $space);

        return view('posts.create', [
            'space' => $space,
        ]);
    }

    public function delete(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('spaces.view', ["space" => $post->space->hash]);
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', [
            'post' => $post,
        ]);
    }
}
