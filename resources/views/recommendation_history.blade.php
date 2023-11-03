<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Recommendation History
        </h2>
    </x-slot>

    @foreach ($Recommendations as $Recommendation)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="pt-6 px-6 pb-2 text-gray-900 dark:text-gray-100">
                        <b>Created at:</b> {{ $Recommendation->created_at }}
                    </div>
                    <div class="py-6 px-6 pt-2 text-gray-900 dark:text-gray-100">
                        <b>Based on these keywords:</b> {{ $Recommendation->recommendation }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="pagination">
                {{ $Recommendations->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>

</x-app-layout>
