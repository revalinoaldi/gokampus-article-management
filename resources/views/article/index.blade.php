<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Article Page') }}
        </h2>
    </x-slot>

    {{-- {{dd($articles)}} --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="mb-10">
                    <a href="{{ route('article.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                        + Create Article
                    </a>
                </div>
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6 ">
                        <div class="relative overflow-x-auto sm:rounded-lg mb-5">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" id="crudTable">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            No.
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Title
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Category
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Author
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Body
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($articles as $item)
                                    {{-- {{ dd($item['category']['name']) }} --}}
                                    <tr class=" border-b @if ($loop->iteration % 2 == 0) 'bg-white' @else 'bg-gray-50' @endif ">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ ($articles->currentPage()-1) * $articles->perPage() + $loop->index + 1 }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $item['title'] }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item['category']['name'] }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item['author']['name'] }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item['excerpt'] }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a class="inline-block border border-gray-700 bg-gray-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline" href="{{ route('article.edit', $item['slug']) }}">
                                                Edit
                                            </a>
                                            <form class="inline-block" action="{{ route('article.destroy', $item['slug']) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button onclick="return confirm('Are you sure?')" class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                        <div class="flex justify-end">
                            {{ $articles->links() }}
                        </div>



                    </div>
                </div>

                {{-- <x-welcome /> --}}

            </div>
        </div>
    </div>
</x-app-layout>
