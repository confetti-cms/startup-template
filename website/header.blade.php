<header class="lg:container lg:mx-auto z-50 backdrop-blur-sm border-b border-gray-100 w-full">
    <nav class="relative">
        <div class="flex items-center justify-between px-4 py-2">
            <!-- Logo Container -->
            <div id="logo" class="flex items-center p-2">
                <a href="/" aria-label="logo" class="flex items-center space-x-4">
                    <img src="/website/assets/logo.png" class="h-10" alt="">
                    <span class="text-xl" id="brand-title">Your Company</span>
                </a>
            </div>
            <div></div>
            <div class="flex justify-end  md:justify-end">
                <!-- Hamburger Icon -->
                <button id="menu-toggle" type="button" aria-label="Toggle Navigation" class="text-gray-600 focus:outline-hidden md:hidden">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                    </svg>
                </button>
                <!-- Navigation Links -->
                <div class="js-menu hidden flex-col space-y-2 px-4 py-2 md:flex md:flex-row md:space-y-0 md:space-x-4 md:border-none md:py-0">
                    <a href="/" class="block md:hidden transition hover:text-primary px-4 py-2 md:py-2">Home</a>
                    <a href="/pricing" class="block relative transition hover:text-primary px-4 py-2 md:py-2">Pricing</a>
                    <a href="/blogs" class="block relative transition hover:text-primary px-4 py-2 md:py-2">Blog</a>
                    <a href="/contact" class="block relative transition hover:text-primary px-4 py-2 md:py-2">Contact</a>
                </div>
            </div>
        </div>
    </nav>
</header>

@pushonce('end_of_body_header')
<script>
    // Toggle menu visibility
    const menuToggle = document.getElementById('menu-toggle');
    const menu = document.getElementsByClassName('js-menu')[0];
    const logo = document.getElementById('logo');

    menuToggle.addEventListener('click', () => {
        menuToggle.classList.toggle('hidden');
        menu.classList.toggle('hidden');
        logo.classList.toggle('hidden');
    });
</script>
@endpushonce
