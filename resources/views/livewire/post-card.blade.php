<div class="flex p-2 my-2 bg-gray-100 rounded">
    <div class="flex-1">
        <h2 class="text-lg">{{ $post->title }}</h2>
        <p class="text-gray-500">{{ $post->description }}</p>
        @isset($post->files)
            @foreach($post->files->flattenKeepKeys() as $fileName => $file)
                <p>
                    <button class="anchor"
                            wire:click="downloadFile('{{ $fileName }}', '{{ $file }}')">{{ $fileName }}</button>
                </p>
            @endforeach
        @endisset
    </div>
    @can('update', $post)
        <a class="self-center" href="{{ route('posts.edit', ['post' => $post->id]) }}">
            <x-tabler-icon icon="edit" strokeWidth="1.5" class="h-6 ml-2"/>
        </a>
    @endcan
    @can('delete', $post)
        <form class="self-center" method="POST"
              action="{{ route('posts.delete', ['post' => $post->id]) }}">
            @method('DELETE')
            @csrf
            <button type="submit" class="self-center">
                <x-tabler-icon icon="trash" strokeWidth="1.5" class="h-6 ml-2"/>
            </button>
        </form>
    @endcan
</div>
