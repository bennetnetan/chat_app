<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div x-data="{ open: false }">
        <button @click="open = !open" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
            Toggle Message
        </button>

        <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
                <button @click="open = false" class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">
                    Cancel
                </button>
            </div>
        </div>
    </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-center">
                        <a href="{{ route('chat.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                            Enter Chat Room
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
