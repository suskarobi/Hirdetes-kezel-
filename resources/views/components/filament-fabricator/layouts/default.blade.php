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
                       class="hover:text-gray-300 transition-colors duration-300">{{$category->name}}</a>
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
                   class="hover:text-gray-300 transition-colors duration-300">{{$category->name}}</a>
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
        <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-8 text-gray-400">
            <div class="space-y-4">
                <h3 class="text-2xl font-bold text-white uppercase tracking-wider">Magyar élet Amerikában</h3>
                <p class="text-sm leading-relaxed">Friss hírek, elemzések és riportok minden nap, megbízható
                    forrásból.</p>
                <div class="flex items-center space-x-4 mt-2">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 4.557a9.816 9.816 0 01-2.828.775 4.932 4.932 0 002.165-2.724 9.867 9.867 0 01-3.127 1.195 4.918 4.918 0 00-8.38 4.482A13.945 13.945 0 011.671 3.149a4.918 4.918 0 001.523 6.573 4.903 4.903 0 01-2.229-.616c-.054 2.28 1.581 4.415 3.949 4.89a4.935 4.935 0 01-2.224.084 4.923 4.923 0 004.598 3.417 9.868 9.868 0 01-6.102 2.105c-.396 0-.788-.023-1.175-.069a13.945 13.945 0 007.557 2.212c9.054 0 14-7.496 14-13.986 0-.21 0-.423-.015-.634A10.012 10.012 0 0024 4.557z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 0C5.372 0 0 5.373 0 12c0 5.302 3.438 9.8 8.205 11.385.6.11.82-.26.82-.577 0-.285-.01-1.04-.016-2.04-3.338.725-4.042-1.61-4.042-1.61-.546-1.387-1.333-1.756-1.333-1.756-1.09-.745.082-.729.082-.729 1.205.085 1.84 1.237 1.84 1.237 1.07 1.834 2.807 1.304 3.492.997.108-.774.418-1.304.762-1.604-2.665-.304-5.466-1.332-5.466-5.933 0-1.31.467-2.382 1.235-3.22-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.3 1.23a11.513 11.513 0 016 0c2.29-1.552 3.297-1.23 3.297-1.23.653 1.652.242 2.873.119 3.176.77.838 1.233 1.91 1.233 3.22 0 4.61-2.804 5.625-5.475 5.921.43.372.814 1.102.814 2.222 0 1.604-.015 2.896-.015 3.29 0 .319.218.694.825.576C20.565 21.796 24 17.298 24 12c0-6.627-5.373-12-12-12z"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="space-y-4">
                <h4 class="text-sm font-semibold uppercase text-white tracking-wider">Gyors linkek</h4>
                <ul class="space-y-2 text-sm">
                    @foreach(\App\Models\NewsCategory::get() as $category)
                        <li><a href="/?category-id={{$category->id}}"
                               class="hover:text-white transition-colors duration-3000">{{$category->name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="space-y-4">
                <h4 class="text-sm font-semibold uppercase text-white tracking-wider">Iratkozz fel hírlevelünkre</h4>
                <form action="#" method="POST" class="flex flex-col sm:flex-row gap-2">
                    <input type="email" placeholder="Email címed"
                           class="w-full px-4 py-2 rounded-md text-black focus:outline-none focus:ring-2 focus:ring-white/50"
                           required>
                    <button type="submit"
                            class="px-4 py-2 bg-white text-black font-semibold rounded-md hover:bg-gray-200 transition-colors duration-300">
                        Feliratkozás
                    </button>
                </form>
                <p class="text-xs text-gray-500 mt-2">Nem osztjuk meg az adataid.</p>
            </div>

        </div>
    </footer>

</x-filament-fabricator::layouts.base>
