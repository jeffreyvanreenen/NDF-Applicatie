@extends('app')
@section('content')
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
@endsection
