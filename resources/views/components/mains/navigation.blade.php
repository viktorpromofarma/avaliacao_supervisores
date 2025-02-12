<nav class="bg-[#E2304E] z-10 text-2xl font-bold">
    <div class="container flex items-center justify-between px-4 py-3 mx-auto">
        <!-- Logo e texto -->
        <div class="flex items-center flex-grow space-x-3">
            <a href="{{ route('home') }}" class="flex items-center text-white hover:text-black">
                <img src="{{ URL::asset('/imgs/índice2.png') }}" class="h-12" alt="Logo">
                <span class="ml-2">Bem-Vindo(a),
                    {{ ucfirst(strtolower(strstr(Auth::user()->display_name, ' ', true))) }}</span>
            </a>
        </div>
        <div class="flex items-center">
            <button type="submit" class="flex items-center px-2 py-2 text-white rounded hover:text-black">
                <a href="{{ route('logout') }}" class="flex items-center">
                    <i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i></a>
            </button>

        </div>
    </div>
</nav>
