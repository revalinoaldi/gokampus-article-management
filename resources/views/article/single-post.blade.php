<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($article->title) }}
        </h2>
    </x-slot>

    {{-- {{dd($article->toArray())}} --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <article class="bg-white rounded-lg shadow-md overflow-hidden">
                    @php
                        $validUrl = filter_var($article->image, FILTER_VALIDATE_URL) ? $article->image : Storage::url(''.$article->image);
                    @endphp
                    <img
                    src="{{ $validUrl }}"
                    alt="{{ $article->slug }}"
                    class="w-full h-48 object-cover"

                    />
                    <div class="px-6 py-4">
                        <h1 class="text-5xl font-bold mb-2">{{ $article->title }}</h1>
                        <div class="text-gray-600 text-sm mb-4">
                            Created on <span class="font-bold">{{ \Carbon\Carbon::parse($article->created_at)->format('F d, Y')}}</span> by
                            <span class="font-bold">{{ $article->author->name }}</span>
                        </div>
                        <div class="text-gray-600 text-sm mb-4">
                            Publish on <span class="font-bold">{{ @$article->is_publish ? \Carbon\Carbon::parse($article->publish_at)->format('F d, Y') : "- (Not published)" }}</span>
                        </div>
                        @auth

                        @if (auth()->user()->id == $article->id || auth()->user()->username == 'administrator')
                            <div class="text-gray-600 text-sm mb-4">
                                <span class="font-bold">Action :</span>
                                <form class="inline-block" action="{{ route('article.update', @$article->slug) }}" method="POST">
                                @method('PUT')
                                @csrf
                                    <input type="text" name="is_publish" value="{{ $article->is_publish ? "0" : "1"}}" hidden>
                                    <input type="text" name="publish" value="only_publish" hidden>
                                @if ($article->is_publish)
                                    <button type="submit" onclick="return confirm('Are you sure want to draf article?')" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-blue-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 ">Draf</button>
                                @else
                                    <button type="submit" onclick="return confirm('Are you sure want to publish article?')" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-blue-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 ">Published</button>
                                @endif
                                </form>

                                <a href="{{ route('article.edit', $article->slug) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</a>
                                <form class="inline-block" action="{{ route('article.destroy', $article->slug) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        @endif
                        @endauth

                        <div class="body-article">
                            {!! $article->body !!}
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</x-app-layout>
