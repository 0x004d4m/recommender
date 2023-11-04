<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Saved Posts
        </h2>
    </x-slot>

    @foreach ($posts as $post)
        <div class="py-12" id="post_{{ $post->post->id }}">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ $post->post->title }}
                    </div>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ $post->post->description }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="pagination">
                {{ $posts->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>

</x-app-layout>
