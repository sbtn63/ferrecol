<article class="p-6 text-base">
    <footer class="flex justify-between items-center mb-2">

        <div class="flex items-center">
            <a href="{{ route('user.show', $post->user->id) }}" class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">{{ '@'.$post->user->username }}</a>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ $post->created_at_for_humans }}
            </p>
        </div>

        @if (Auth::user()->id == $post->user->id)
            <button id="dropdownPostProfile{{ $post->id }}Button" data-dropdown-toggle="dropdownPostProfile{{ $post->id }}"
            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                    <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                </svg>
                <span class="sr-only">Comment settings</span>
            </button>

            <!-- Dropdown menu -->
            <div  id="dropdownPostProfile{{ $post->id }}" class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownPostProfile{{ $post->id }}">
                    <li>
                        <form action="{{ route('post.destroy', $post->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" type="submit">Eliminar</button>
                        </form>
                    </li>
                    <li>
                        <button class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-target="edit-modal-{{ $post->id }}" data-modal-toggle="edit-modal-{{ $post->id }}" type="button">
                        Editar
                        </button>
                    </li>
                    <li>
                        <a href="{{ route('post.index') }}#post-{{ $post->id }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        Ver Publicacion
                        </a>
                    </li>
                </ul>
            </div>
        @endif

    </footer>

    <div class="mb-4 md:flex md:gap-4">
        <!-- Imagen -->
         @if (!empty($post->file_url))
            <img class="w-full md:w-48 h-auto rounded-lg object-cover" src="{{ asset('images/'.$post->file_url) }}" alt="{{ $post->title }}">
         @endif
    
        <!-- Contenido -->
        <div class="mt-4 md:mt-0">
            <p class="font-semibold dark:text-gray-400 text-sm md:text-base">{{ $post->title }}</p>
            <p class="text-gray-500 dark:text-gray-400 text-sm md:text-base">{{ $post->content }}</p>

            <!-- Badges -->
            <div class="flex flex-wrap mt-4">
                <span class="inline-block bg-gray-200 text-gray-800 rounded px-3 py-1 text-xs font-semibold mr-2 mb-2">{{ $post->train_station->name }}</span>
                <span class="inline-block bg-gray-200 text-gray-800 rounded px-3 py-1 text-xs font-semibold mr-2 mb-2">{{ $post->train_station->municipality->name }}</span>
                <span class="inline-block bg-gray-200 text-gray-800 rounded px-3 py-1 text-xs font-semibold mb-2">{{ $post->train_station->municipality->departament->name }}</span>
            </div>
        </div>
    </div>

    <div class="flex items-center mt-4 space-x-4">
        <p class="toggle-button  flex items-center text-sm text-gray-500 dark:text-gray-400 font-medium">
            <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
            </svg>
            Comentarios ( {{ $post->comments->count() }} )
        </p>
    </div>
</article>

@include('layouts._partials.modalEdit')