<nav class="bg-[#E2304E] z-10 text-2xl font-bold w-full">
    <div class="container flex items-center justify-between px-4 py-3 mx-auto">
        <!-- Logo e texto -->
        <div class="flex items-center flex-grow space-x-4">
            <a href="{{ route('home') }}" class="flex items-center text-white hover:text-black">
                <img src="{{ URL::asset('/imgs/índice2.png') }}" class="h-12" alt="Logo">
                <span class="ml-2">Bem-Vindo(a), {{ Auth::user()->display_name }}</span>
            </a>
        </div>

        <!-- Menu Hambúrguer -->
        <div class="relative">
            <button id="menuButton" class="text-white focus:outline-none">
                <i class="text-3xl fa-solid fa-bars"></i>
            </button>
        </div>
    </div>
</nav>

<!-- Painel do Menu Hambúrguer -->
<div id="menuPanel"
    class="fixed inset-y-0 right-0 z-20 w-64 transition-transform duration-300 ease-in-out transform translate-x-full bg-white shadow-lg">
    <div class="p-4">
        <a href="{{ route('user.profile') }}" class="flex items-center px-4 py-2 text-black hover:bg-gray-200">
            <i class="fa-solid fa-user"></i>
            <span class="ml-2">Perfil</span>
        </a>
        <a href="{{ route('logout') }}" class="flex items-center px-4 py-2 text-black hover:bg-gray-200">
            <i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i>
            <span class="ml-2">Sair</span>
        </a>

    </div>
</div>

<div id="overlay" class="fixed inset-0 z-10 hidden bg-black bg-opacity-50"></div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuButton = document.getElementById('menuButton');
        const menuPanel = document.getElementById('menuPanel');
        const overlay = document.getElementById('overlay');

        menuButton.addEventListener('click', () => {
            menuPanel.classList.toggle('translate-x-full');
            overlay.classList.toggle('hidden');
        });

        overlay.addEventListener('click', () => {
            menuPanel.classList.add('translate-x-full');
            overlay.classList.add('hidden');
        });
    });
</script>
