<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-2xl font-semibold mb-4">All Cakes</h2>

        <div class="grid grid-cols-2 gap-4">
            @foreach ($cakes as $cake)
            <div class="bg-white p-4 rounded-lg shadow-md relative">
                <h3 class="text-xl font-semibold">{{ $cake->name }}</h3>
                <p class="text-gray-600">Price: {{ number_format($cake->price) }} Ft</p>
                <img src="{{ asset('storage/' . $cake->image_path) }}" alt="{{ $cake->name }}" class="mt-2 rounded-lg h-36">
                @if ($cake->user->is(auth()->user()))
                    <div class="absolute top-4 right-4">
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('cakes.edit', $cake)">
                                    {{ __('Edit') }}
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('cakes.destroy', $cake) }}">
                                    @csrf
                                    @method('delete')
                                    <x-dropdown-link :href="route('cakes.destroy', $cake)" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Delete') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif
                <div class="absolute bottom-0 right-0">
                    <form method="POST" action="{{ route('orders.store') }}" class="absolute bottom-4 right-4">
                        @csrf
                        <input type="hidden" name="cake_id" value="{{ $cake->id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                        <button type="submit" class="text-black hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 902.86 902.86" xml:space="preserve" width="32" height="32">
                                <g>
                                    <g>
                                        <path d="M671.504,577.829l110.485-432.609H902.86v-68H729.174L703.128,179.2L0,178.697l74.753,399.129h596.751V577.829z
                                            M685.766,247.188l-67.077,262.64H131.199L81.928,246.756L685.766,247.188z"/>
                                        <path d="M578.418,825.641c59.961,0,108.743-48.783,108.743-108.744s-48.782-108.742-108.743-108.742H168.717
                                            c-59.961,0-108.744,48.781-108.744,108.742s48.782,108.744,108.744,108.744c59.962,0,108.743-48.783,108.743-108.744
                                            c0-14.4-2.821-28.152-7.927-40.742h208.069c-5.107,12.59-7.928,26.342-7.928,40.742
                                            C469.675,776.858,518.457,825.641,578.418,825.641z M209.46,716.897c0,22.467-18.277,40.744-40.743,40.744
                                            c-22.466,0-40.744-18.277-40.744-40.744c0-22.465,18.277-40.742,40.744-40.742C191.183,676.155,209.46,694.432,209.46,716.897z
                                            M619.162,716.897c0,22.467-18.277,40.744-40.743,40.744s-40.743-18.277-40.743-40.744c0-22.465,18.277-40.742,40.743-40.742
                                            S619.162,694.432,619.162,716.897z"/>
                                    </g>
                                </g>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
