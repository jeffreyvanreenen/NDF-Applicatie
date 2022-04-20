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
            <form method="post" action="{{ route('search-terms-update', $searchstring->id) }}" autocomplete="off">@csrf

                <div class="mb-4 w-3/6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Naam
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="name" name="name" type="text" placeholder="Naam" value="{{ $searchstring->name }}">
                </div>
                <div class="mb-4 w-3/6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="searchterm">
                        Zoekterm
                    </label>
                    <textarea
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="searchterm" name="searchterm">{{ $searchstring->searchterm }}</textarea>
                </div>
                <div class="mb-4 w-3/6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="telegram_chat_id">
                        Telegram Chat ID (leeglaten is disabled)
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="telegram_chat_id" name="telegram_chat_id" type="text" placeholder="Telegram chat id: bijv. -776907660" value="{{ $searchstring->telegram_chat_id }}">
                </div>
                <div class="mb-4 w-1/6">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Opslaan
                    </button>
                    <a href="{{ route('search-terms-delete', $searchstring->id) }}" onclick="return confirm('Are you sure?')">
                        <button
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="button">
                            Verwijderen
                        </button>
                    </a>
                </div>
            </form>
        </div>
        <div class="">
            <table class="table-auto w-full text-sm">
                <thead class="border-b">
                <tr>
                    <th scope="col" class="px-6 py-4">#</th>
                    <th scope="col" class="px-6 py-4">Titel</th>
                    <th scope="col" class="px-6 py-4">Omschrijving</th>
                    <th scope="col" class="px-6 py-4">Bron</th>
                    <th scope="col" class="px-6 py-4">Datum</th>
                    <th scope="col" class="px-6 py-4">Auteur</th>
                </tr>
                </thead>
                <tbody>
                @foreach($artikelen as $artikel)
                    <tr class="border-b">
                        <td class="px-6 py-4"><a href="{{ $artikel->link }}" target="_blank">{{ $artikel->id }}</a></td>
                        <td class="px-6 py-4">{{ $artikel->title }}</td>
                        <td class="px-6 py-4">{!! $artikel->description !!}</td>
                        <td class="px-6 py-4">{{ $artikel->source }}</td>
                        <td class="px-6 py-4">{{ $artikel->pubDate }}</td>
                        <td class="px-6 py-4">{{ $artikel->author }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="flex flex-col pt-8 space-x-2 text-start">
                {{ $artikelen->links() }}
            </div>
        </div>
    </div>
@endsection
