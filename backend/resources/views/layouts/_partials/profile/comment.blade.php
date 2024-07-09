<article  class="p-6 mb-3 ml-6 lg:ml-12 text-base bg-white rounded-lg dark:bg-gray-900">
    <footer class="flex justify-between items-center mb-2">
        <div class="flex items-center">
            <a  href="{{ route('user.show', $comment->user->id) }}" class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">{{ '@'.$comment->user->username }}</a>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ $comment->created_at_for_humans }}
            </p>
        </div>

        <div class="relative mt-2">
            <button id="dropdownCommentProfile{{ $comment->id }}Button"
                    data-dropdown-toggle="dropdownCommentProfile{{ $comment->id }}"
                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                     type="button">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                    <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                </svg>
                <span class="sr-only">Comment settings</span>
            </button>
                
                <!-- Dropdown menu -->
            <div id="dropdownCommentProfile{{ $comment->id }}"
                class="hidden absolute z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownCommentProfile{{ $comment->id }}">
                    <li>
                            <a href="{{ route('post.index') }}#post-{{ $comment->post->id }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            Ver Publicacion
                            </a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
    
    <p class="text-gray-500 dark:text-gray-400">{{ $comment->content }}</p>

</article>