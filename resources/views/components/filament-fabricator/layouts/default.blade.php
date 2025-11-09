
@props(['page'])
<x-filament-fabricator::layouts.base :title="$page->title">
    <header class="fixed top-0 left-0 right-0 bg-black/90 backdrop-blur-md border-b border-white/20 z-50">
        <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
            <h1 class="text-2xl font-extrabold tracking-tight text-white">HIRZÓNA</h1>
            <nav class="hidden md:flex gap-6 text-sm uppercase font-semibold text-white">
                <a href="#" class="hover:text-gray-300 transition-colors duration-300">Belföld</a>
                <a href="#" class="hover:text-gray-300 transition-colors duration-300">Külföld</a>
                <a href="#" class="hover:text-gray-300 transition-colors duration-300">Gazdaság</a>
                <a href="#" class="hover:text-gray-300 transition-colors duration-300">Tech</a>
                <a href="#" class="hover:text-gray-300 transition-colors duration-300">Kultúra</a>
                <a href="#" class="hover:text-gray-300 transition-colors duration-300">Sport</a>
                <a href="#" class="hover:text-gray-300 transition-colors duration-300">Vélemény</a>
            </nav>
        </div>
    </header>
    <x-filament-fabricator::page-blocks :blocks="$page->blocks" />
    <footer class="bg-black/90 border-t border-white/20 mt-auto">
        <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-8 text-gray-400">
            <div class="space-y-4">
                <h3 class="text-xl font-bold text-white uppercase tracking-wider">HIRZÓNA</h3>
                <p class="text-sm leading-relaxed">Friss hírek, elemzések és riportok minden nap, megbízható
                    forrásból.
                </p>
            </div>

            <div class="space-y-4">
                <h4 class="text-sm font-semibold uppercase text-white tracking-wider">Gyors linkek</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white transition-colors duration-300">Belföld</a></li>
                    <li><a href="#" class="hover:text-white transition-colors duration-300">Külföld</a></li>
                    <li><a href="#" class="hover:text-white transition-colors duration-300">Gazdaság</a></li>
                    <li><a href="#" class="hover:text-white transition-colors duration-300">Tech</a></li>
                    <li><a href="#" class="hover:text-white transition-colors duration-300">Sport</a></li>
                </ul>
            </div>
        </div>
    </footer>
</x-filament-fabricator::layouts.base>
