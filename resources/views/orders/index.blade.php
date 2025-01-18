<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-2xl font-semibold mb-4">My Orders</h2>

        <div class="grid grid-cols-1 gap-4">
            @foreach ($orders as $order)
                <div class="bg-white p-4 rounded-lg shadow-md relative">
                    <h3 class="text-xl font-semibold">Order ID: {{ $order->id }}</h3>
                    <p class="text-gray-600">Cake: {{ $order->cake->name }}</p>
                    <p class="text-gray-600">Order Date: {{ $order->created_at->format('j M Y, g:i a') }}</p>

                    @if ($order->user->is(auth()->user()))
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
                                    <form method="POST" action="{{ route('orders.destroy', $order) }}">
                                        @csrf
                                        @method('delete')
                                        <x-dropdown-link :href="route('orders.destroy', $order)" onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Cancel Order') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
