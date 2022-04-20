@extends('app')
@section('content')
    <div class="flex flex-col space-y-2">
        <div>
            <div class="mb-4 w-2/6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
            <form method="post" action="{{ route('search-terms-save') }}" autocomplete="off">@csrf

                <div class="mb-4 w-3/6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Naam
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="name" name="name" type="text" placeholder="Naam">
                </div>
                <div class="mb-4 w-3/6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="searchterm">
                        Zoekterm
                    </label>
                    <textarea
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="searchterm" name="searchterm"></textarea>
                </div>
                <div class="mb-4 w-3/6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="telegram_chat_id">
                        Telegram Chat ID (leeglaten is disabled)
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="telegram_chat_id" name="telegram_chat_id" type="text" placeholder="Telegram chat id: bijv. -776907660">
                </div>
                <div class="mb-4 w-1/6">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Opslaan
                    </button>
                </div>
            </form>
        </div>
        <div class="">
            <table class="table-auto w-full text-sm">
                <thead class="border-b">
                <tr>
                    <th scope="col" class="px-6 py-4">#</th>
                    <th scope="col" class="px-6 py-4">Naam</th>
                    <th scope="col" class="px-6 py-4">Searchterm</th>
                </tr>
                </thead>
                <tbody>
                @foreach($searchterms as $searchterm)
                    <tr class="border-b text-center">
                        <td class="px-6 py-4">{{ $searchterm->id }}</td>
                        <td class="px-6 py-4"><a href="{{ route('search-results', $searchterm->id) }}">{{ $searchterm->name }}</a></td>
                        <td class="px-6 py-4">{{ $searchterm->searchterm }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>



@endsection
