<div class="mt-8 ml-3 ">
    @if (session()->has('success'))
        <div class="fixed top-16 right-3 z-[1050]">
            <div class="px-4 py-3 text-center text-white bg-green-500 rounded-lg shadow-lg" id="success-alert">
                {{ session('success') }}
            </div>
        </div>
    @elseif (session()->has('error'))
        <div class="fixed top-16 right-3 z-[1050]">
            <div class="px-4 py-3 text-center text-white bg-red-500 rounded-lg shadow-lg" id="error-alert">
                {{ session('error') }}
            </div>
        </div>
    @endif
</div>
