<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Space;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class PostCard extends Component
{
    public Post $post;
    public Space $space;

    public function downloadFile(string $fileName, string $file)
    {
        return Storage::download($file, $fileName);
    }

    public function render()
    {
        return view('livewire.post-card');
    }
}
