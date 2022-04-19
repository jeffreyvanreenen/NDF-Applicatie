@extends('app')
@section('content')
    <div class="flex flex-col space-y-2">
        <div>
            <div class="mb-4 w-1/6">
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
            <form method="post" action="{{ route('rssfeeds.save') }}" autocomplete="off">@csrf

                <div class="mb-4 w-1/6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="link">
                        Link naar RSS file
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="link" name="link" type="text" placeholder="Link naar RSS file">
                </div>
                <div class="mb-4 w-1/6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="actief">
                        Actief
                    </label>
                    <select
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="actief" name="actief">
                        <option value="1" selected>Ja</option>
                        <option value="0">Nee</option>
                    </select>
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
                    <th scope="col" class="px-6 py-4">Logo</th>
                    <th scope="col" class="px-6 py-4">Omschrijving</th>
                    <th scope="col" class="px-6 py-4">Link</th>
                    <th scope="col" class="px-6 py-4">Actief</th>
                    <th scope="col" class="px-6 py-4">Updated at</th>
                    <th scope="col" class="px-6 py-4">Created at</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rsses as $rss)
                    <tr class="border-b text-center">
                        <td class="px-6 py-4">{{ $rss->id }}</td>
                        <td class="px-6 py-4 flex items-center justify-center"><img class="w-16 h-16"
                                                                                    src="{{ $rss->logo }}"></td>
                        <td class="px-6 py-4">{!! $rss->omschrijving !!}</td>
                        <td class="px-6 py-4"><a href="{{ $rss->link }}" target="_blank">{{ $rss->link }}</a></td>
                        <td class="px-6 py-4">@if($rss->actief == 1)<i class="fas fa-eye"></i>@else<i
                                class="fas fa-eye-slash"></i>@endif</td>
                        <td class="px-6 py-4">{{ $rss->updated_at }}</td>
                        <td class="px-6 py-4">{{ $rss->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="flex flex-col pt-8 space-x-2 text-start">
                {{ $rsses->links() }}
            </div>
            <div class="mt-4 w-1/6">
               <a href="{{ route('scrape.rss.execute') }}"><button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="button">
                    Scrape
                   </button></a>
            </div>
        </div>
    </div>



@endsection
