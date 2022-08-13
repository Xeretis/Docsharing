<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Space;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostForm extends Component
{
    use WithFileUploads;

    public Space $space;
    public ?Post $post;

    public string $title;
    public string $description = '';

    public $files;
    public int $uploadedCount;

    protected $rules = [
        'title' => 'required|max:255',
        'description' => 'required|max:2048',
        'files.*' => 'file|max:20480'
    ];

    public function mount()
    {
        $this->title = $this->post->title ?? '';
        $this->description = $this->post->description ?? '';
        $this->files = [];
        $this->uploadedCount = isset($this->post) ? $this->post->files->count() : 0;
    }

    public function submit()
    {
        $this->validate();

        $paths = collect([]);

        foreach ($this->files as $file) {
            $paths->add([$file->getClientOriginalName() => $file->store('uploads')]);
        }

        if (isset($this->post)) {
            $this->post->update([
                "title" => $this->title,
                "description" => $this->description,
                "files" => $paths
            ]);

            return redirect()->route('spaces.view', ["space" => $this->space->hash]);
        }

        Post::create([
            "title" => $this->title,
            "description" => $this->description,
            "space_id" => $this->space->id,
            "files" => $paths
        ]);

        return redirect()->route('spaces.view', ["space" => $this->space->hash]);
    }

    public function clearFiles()
    {
        $this->files = [];
        $this->uploadedCount = 0;
    }

    public function updatedFiles()
    {
        $this->validate([
            'files.*' => 'file|max:20480'
        ]);

        $this->uploadedCount = count($this->files);
    }

    public function render()
    {
        return view('livewire.post-form');
    }
}
