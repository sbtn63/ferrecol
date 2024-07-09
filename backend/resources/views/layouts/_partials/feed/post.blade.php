
<div id="post-{{ $post->id }}" class="p-4 rounded-lg shadow-md border-l-4 bg-white border-blue-600 mb-6 dark:bg-gray-900">
<article class="p-6 text-base">
    <footer class="flex justify-between items-center mb-2">

        <div class="flex items-center">
            <a href="{{ route('user.show', $post->user->id) }}" class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">{{ '@'.$post->user->username }}</a>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ $post->created_at_for_humans }}
            </p>
        </div>

        @if (Auth::user()->id == $post->user->id)
        <button id="dropdownPost{{ $post->id }}Button" data-dropdown-toggle="dropdownPost{{ $post->id }}" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
            </svg>
            <span class="sr-only">Comment settings</span>
        </button>

        <!-- Dropdown menu -->
        <div id="dropdownPost{{ $post->id }}" class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownPost{{ $post->id }}">
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
        <button data-toggle-target="#article-{{ $post->id }}" type="button" class="toggle-button  flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
            <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
            </svg>
            Comentarios ( {{ $post->comments->count() }} )
        </button>
    </div>

</article>

<div id="article-{{ $post->id }}" class="hidden mt-4">
    @foreach ($post->comments as $comment )
        @include('layouts._partials.feed.comment')
    @endforeach
</div>

<article class="mt-2">
    <form class="mb-6" action="{{ route('comment.store') }}" method="post">
        @csrf
        
        <div>
            <input type="number" hidden name="post" value="{{ $post->id }}">
        </div>

        <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <label for="content" class="sr-only">Your comment</label>
            <textarea id="content" name="content"  rows="2"
                class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                placeholder="Escribe un comentario ...." required></textarea>
        </div>
        <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                Comentar
        </button>
    </form>
</article>
</div>

@include('layouts._partials.modalEdit')