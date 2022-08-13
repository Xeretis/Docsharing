<div class="relative top-0 left-0 right-0 m-4">
    <div class="flex flex-row items-center justify-between">
        <a href="/" class="text-xl font-bold">Docsharing</a>

        <div class="space-x-4">
            <a href="/spaces" class="font-semibold text-indigo-500">
                Spaces
            </a>
            <a
                href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="font-semibold text-indigo-500"
            >
                Log out
            </a>
        </div>


        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</div>
