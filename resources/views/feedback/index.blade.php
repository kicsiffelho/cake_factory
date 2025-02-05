<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('feedback.store') }}">
            @csrf
            <textarea
                name="message"
                placeholder="{{ __('Please tell us how much you enjoyed our cakes! :)') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <button class="mt-4 bg-black text-white px-4 py-2 rounded-lg">{{ __('Send') }}</button>
        </form>
    </div>
</x-app-layout>
