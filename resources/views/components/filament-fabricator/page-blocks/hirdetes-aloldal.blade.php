@aware(['page'])
<div class="bg-gray-950 text-white font-sans min-h-screen overflow-x-hidden">
    <section class="max-w-4xl mx-auto px-6 pt-[120px] pb-16">

        @if($hirdetes)
            <div class="mb-10">
                <a href="{{ url()->previous() }}"
                   class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Vissza
                </a>
            </div>

            <div class="bg-gray-900 border border-gray-700 rounded-3xl overflow-hidden shadow-2xl">
                @if(!empty($hirdetes->thumbnail_url))
                    <div class="relative">
                        <img src="{{ $hirdetes->thumbnail_url }}"
                             alt="{{ $hirdetes->title }}"
                             class="w-full h-[400px] object-cover cursor-pointer"
                             data-lightbox="hirdetes-gallery"
                             data-title="{{ $hirdetes->title }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                    </div>
                @endif

                <div class="p-8">
                    <p class="text-xs uppercase text-gray-400 tracking-widest mb-2">
                        {{ $hirdetes->category ?? 'Általános' }}
                    </p>

                    <h1 class="text-3xl font-bold text-white mb-4">
                        {{ $hirdetes->title }}
                    </h1>

                    @if($hirdetes->created_at)
                        <p class="text-sm text-gray-500 mb-6">
                            Közzétéve: {{ $hirdetes->created_at->format('Y. F j.') }}
                        </p>
                    @endif

                    <div class="text-gray-300 text-base leading-relaxed space-y-4">
                        {!! $hirdetes->description !!}
                    </div>

                    @if(!empty($hirdetes->images_urls))
                        <div class="mt-8 grid grid-cols-2 sm:grid-cols-3 gap-4">
                            @foreach($hirdetes->images_urls as $image)
                                <a href="{{ $image }}" data-lightbox="hirdetes-gallery" class="block overflow-hidden rounded-lg shadow-lg hover:scale-105 transition-transform">
                                    <img src="{{ $image }}" alt="{{ $hirdetes->title }}" class="w-full h-40 object-cover">
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @else
            <p class="text-center text-gray-400 mt-20">A hirdetés nem található.</p>
        @endif

    </section>
</div>



