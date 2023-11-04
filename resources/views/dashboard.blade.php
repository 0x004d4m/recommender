<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Home
        </h2>
    </x-slot>

    @foreach ($posts as $post)
        <div class="py-12" id="post_{{ $post->id }}">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ $post->title }}
                    </div>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ $post->description }}
                    </div>
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between">
                        <div>
                            <button form="like_post_{{ $post->id }}" type="submit">
                                @if ($post->isLikedByUser($user))
                                    <svg class="h-8 w-8 text-red-500" width="24" height="24" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <path d="M12 20l-7 -7a4 4 0 0 1 6.5 -6a.9 .9 0 0 0 1 0a4 4 0 0 1 6.5 6l-7 7" />
                                    </svg>
                                @else
                                    <svg class="h-8 w-8 text-white" width="24" height="24" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <path d="M12 20l-7 -7a4 4 0 0 1 6.5 -6a.9 .9 0 0 0 1 0a4 4 0 0 1 6.5 6l-7 7" />
                                    </svg>
                                @endif
                            </button>

                            <button form="save_post_{{ $post->id }}" type="submit">
                                @if ($post->isSavedByUser($user))
                                    <svg class="h-8 w-8 text-green-500" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                                        <polyline points="17 21 17 13 7 13 7 21" />
                                        <polyline points="7 3 7 8 15 8" />
                                    </svg>
                                @else
                                    <svg class="h-8 w-8 text-white" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                                        <polyline points="17 21 17 13 7 13 7 21" />
                                        <polyline points="7 3 7 8 15 8" />
                                    </svg>
                                @endif
                            </button>

                            <form
                                action="{{ route('posts.like', ['postId' => $post->id]) . '?page=' . Request::get('page') ?? 1 }}"
                                method="POST" id="like_post_{{ $post->id }}">
                                @csrf
                            </form>
                            <form
                                action="{{ route('posts.save', ['postId' => $post->id]) . '?page=' . Request::get('page') ?? 1 }}"
                                method="POST" id="save_post_{{ $post->id }}">
                                @csrf
                            </form>
                        </div>

                        @if ($post->isRatedByUser($user) ?? 0)
                            <x-static-star-rating rating="{{ $post->getRateByUser($user) }}" />
                        @else
                            <x-interactive-rating-star postId="{{ $post->id }}" />
                        @endif
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
