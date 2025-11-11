<div class="text-white font-sans overflow-x-hidden min-h-screen">
    <section class="max-w-7xl mx-auto px-6 pt-[120px] pb-12">
        <div class="flex items-center justify-center mb-8">
            <h2 class="text-2xl font-bold uppercase tracking-wider text-white text-center">
                Híreink
            </h2>
        </div>

        <!-- 4 oszlopos elrendezés, minden képernyőmérethez -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 items-start">
            @if($hirdetesek->count())
                @foreach($hirdetesek as $hirdetes)
                    <div
                        class="group relative bg-gray-900 border border-gray-700 rounded-3xl overflow-hidden shadow-2xl transform transition-all duration-700 ease-out hover:-translate-y-3 hover:scale-105 hover:shadow-white/50 animate-fade-up w-72 h-96 flex flex-col justify-between">

                        @if($hirdetes->thumbnail_url)
                            <div class="relative w-full h-1/2 overflow-hidden rounded-t-3xl">
                                <img src="{{ $hirdetes->thumbnail_url }}" alt="{{ $hirdetes->title }}"
                                     class="w-full h-full object-cover grayscale contrast-125 group-hover:grayscale-0 group-hover:scale-110 transition-transform duration-700 ease-out">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-90 transition-opacity duration-500 group-hover:opacity-75">
                                </div>
                            </div>
                        @endif

                        <div class="p-4 flex flex-col justify-between h-1/2">
                            <p class="text-xs uppercase text-gray-400 tracking-widest mb-1">
                                {{ $hirdetes->category ?? 'Általános' }}
                            </p>
                            <h2
                                class="text-sm font-bold text-white group-hover:text-white/90 transition-colors duration-300 mb-2">
                                {{ $hirdetes->title }}
                            </h2>
                            <div class="text-gray-300 text-xs line-clamp-2">
                                {!! $hirdetes->short_description !!}
                            </div>
                            <a href="{{ url($hirdetes->slug) }}"
                               class="mt-2 inline-flex items-center justify-center gap-1 text-xs uppercase tracking-wider font-semibold text-black bg-white rounded-full px-2 py-1 hover:bg-gray-200">
                                Részletek
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300"
                                     fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        @if(!$hirdetesek->count())
            <div class="grid items-center justify-center">
                <p class="text-center text-gray-400 py-5">Hírdetések nem találhatóak ebben a kategoriában.</p>
            </div>
        @endif

        <div class="flex justify-center mt-6">
            <ul class="flex items-center space-x-2">
                @if ($hirdetesek->onFirstPage())
                    <li>
                <span class="px-4 py-2 bg-gray-300 text-gray-500 rounded-md cursor-not-allowed">
                    &laquo; Előző
                </span>
                    </li>
                @else
                    <li>
                        <a href="{{ $hirdetesek->previousPageUrl() }}"
                           class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 transition-colors">
                            &laquo; Előző
                        </a>
                    </li>
                @endif

                @foreach ($hirdetesek->links() as $link)
                    <li>
                        @if ($link['active'])
                            <span class="px-4 py-2 bg-blue-500 text-white rounded-md">
                        {{ $link['label'] }}
                    </span>
                        @else
                            <a href="{{ $link['url'] }}"
                               class="px-4 py-2 text-gray-800 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors">
                                {{ $link['label'] }}
                            </a>
                        @endif
                    </li>
                @endforeach

                @if ($hirdetesek->hasMorePages())
                    <li>
                        <a href="{{ $hirdetesek->nextPageUrl() }}"
                           class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 transition-colors">
                            Következő &raquo;
                        </a>
                    </li>
                @else
                    <li>
                <span class="px-4 py-2 bg-gray-300 text-gray-500 rounded-md cursor-not-allowed">
                    Következő &raquo;
                </span>
                    </li>
                @endif
            </ul>
        </div>

    </section>
</div>
