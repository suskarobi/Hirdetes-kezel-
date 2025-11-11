@props(['page'])
<x-filament-fabricator::layouts.base :title="$page->title">
    <header class="fixed top-0 left-0 right-0 bg-black/90 backdrop-blur-md border-b border-white/20 z-50">
        <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">

            <a href="/" class="flex items-center g[ap-3">
                <h1 class="text-2xl font-extrabold tracking-tight text-white">Magyar élet Amerikában</h1>
            </a>

            <nav class="hidden md:flex gap-6 text-sm uppercase font-semibold text-white">
                @foreach(\App\Models\NewsCategory::get() as $category)
                    <a href="/?category-id={{$category->id}}"
                       class="hover:text-gray-300 transition-colors duration-300 {{request()->has('category-id') && request()->get('category-id') == $category->id ? 'text-blue-500 font-bold' : ''}}">{{$category->name}}</a>
                @endforeach
            </nav>

            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden bg-black/90 border-t border-white/20">
            @foreach(\App\Models\NewsCategory::get() as $category)
                <a href="/?category-id={{$category->id}}"
                   class="hover:text-gray-300 transition-colors duration-300 {{request()->has('category-id') && request()->get('category-id') == $category->id ? 'text-blue-500 font-bold' : ''}}">{{$category->name}}</a>
            @endforeach
        </div>

    </header>

    <script>
        const menuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        menuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

    <x-filament-fabricator::page-blocks :blocks="$page->blocks"/>
    <footer class="bg-black/90 border-t border-white/20 mt-auto">
        <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-12 text-gray-400">
            <div class="space-y-4">
                <h3 class="text-2xl font-bold text-white uppercase tracking-wider">Magyar élet Amerikában</h3>
                <p class="text-sm leading-relaxed">Friss hírek, elemzések és riportok minden nap, megbízható
                    forrásból.</p>
            </div>
            <div class="space-y-4">
                <h4 class="text-sm font-semibold uppercase text-white tracking-wider mb-2">Gyors linkek</h4>
                <div class="grid grid-cols-2 gap-2 text-sm">
                    @foreach(\App\Models\NewsCategory::get() as $category)
                        <a href="/?category-id={{$category->id}}"
                           class="hover:text-white transition-colors duration-3000 block {{request()->has('category-id') && request()->get('category-id') == $category->id ? 'text-blue-500 font-bold' : ''}}">{{$category->name}}
                        </a>

                    @endforeach
                </div>
            </div>
            <div class="space-y-4">
                <h4 class="text-sm font-semibold uppercase text-white tracking-wider">Kapcsolat</h4>
                <p class="text-sm">Email: info@magyarleteletamerikaban.com</p>
                <p class="text-sm">Telefon: +1 234 567 890</p>
            </div>
        </div>
    </footer>


</x-filament-fabricator::layouts.base>
