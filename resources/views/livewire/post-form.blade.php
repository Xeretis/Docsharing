<div class="flex flex-col items-center w-full h-full">
    @csrf
    <label for="title" class="self-start mt-3">Title</label>
    <input type="text" wire:model.defer="title" id="title" value="{{ old('name') }}"
           class="w-full input @error('title') border-red-500 @enderror">
    @error('title')
    <p class="self-start text-red-500">{{ $message }}</p>
    @enderror
    <label for="description" class="self-start mt-3">Description</label>
    <textarea id="description" rows="5" wire:model.defer="description"
              class="w-full input @error('description') border-red-500 @enderror"></textarea>
    @error('description')
    <p class="self-start text-red-500">{{ $message }}</p>
    @enderror
    <p class="mt-3">{{ $uploadedCount }} file(s) attached. @if($uploadedCount > 0)
            <button class="anchor" wire:click="clearFiles">Clear</button>
        @endif </p>
    <div class="flex items-center justify-center w-full">
        <label class="flex flex-col w-full h-32 border-4 rounded hover:bg-gray-100 hover:border-gray-300">
            <div class="flex flex-col items-center justify-center pt-7">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400 group-hover:text-gray-600"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                </svg>

                <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                    Attach files</p>
            </div>
            <input type="file" wire:model="files" class="opacity-0" multiple/>
        </label>
    </div>
    @error('files.*')
    <p class="self-start text-red-500">{{ $message }}</p>
    @enderror
    <div class="flex flex-row items-start justify-between w-full mt-3">
        <a href="{{ route('spaces.view', ['space' => $space->hash]) }}" class="primary-button">Back</a>
        <button wire:click="submit" class="primary-button">Save</button>
    </div>
</div>
