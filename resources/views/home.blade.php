<h1>Home</h1>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <h1>{{ $teste }}</h1>
    <button type="submit" class="flex items-center justify-between w-full px-2 py-2 rounded hover:bg-gray-800">
        Sair
        <i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i>
    </button>
</form>
