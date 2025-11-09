    <div class=" text-white font-sans overflow-x-hidden min-h-screen">

        <section class="max-w-7xl mx-auto px-6 py-12 bg-black/90">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold uppercase tracking-wider text-white">Friss hírek</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($hirdetesek as $hirdetes)
                    <div
                        class="group relative overflow-hidden bg-black/80 border border-white/20 rounded-2xl shadow-lg shadow-white/20 hover:shadow-white/40 transition-all duration-500 transform hover:-translate-y-1 hover:scale-[1.01] h-[450px]">

                        @if($hirdetes->thumbnail_url)
                            <div class="relative w-full h-48 overflow-hidden rounded-t-2xl">
                                <img src="{{ $hirdetes->thumbnail_url }}" alt="{{ $hirdetes->title }}"
                                    class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-transform duration-700 ease-out">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-80">
                                </div>
                            </div>
                        @endif

                        <div class="p-6 flex flex-col justify-between h-[calc(100%-12rem)]">
                            <div>
                                <p class="text-xs uppercase text-gray-400 tracking-widest mb-2">
                                    {{ $hirdetes->category ?? 'Általános' }}
                                </p>
                                <h2
                                    class="text-xl font-bold text-white group-hover:text-white/90 transition-colors duration-300 mb-2">
                                    {{ $hirdetes->title }}
                                </h2>
                                <div class="text-gray-300 text-sm leading-relaxed line-clamp-4">
                                    {!! $hirdetes->short_description !!}
                                </div>
                            </div>
                            <a href="{{ url($hirdetes->slug) }}"
                                class="mt-4 inline-flex items-center justify-center gap-2 text-sm uppercase tracking-wider font-semibold text-black bg-white rounded-full px-4 py-2 transition-all duration-300 hover:bg-gray-200 hover:text-black">
                                Részletek
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $hirdetesek->links() }}
        </section>

    </div>