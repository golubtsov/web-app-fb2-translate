@extends('layouts.app')

@section('content')
    <div class="">
        <x-titles.main-title
            title="{{$level}}"
        />
        <div class="mt-5 grid max-md:grid-cols-1 gap-x-8 grid-cols-2">
            @if(count($books) == 0)
                <p>Книг нет</p>
            @endif

            @foreach($books as $book)
                <x-book.card
                    :book=$book
                />
            @endforeach
        </div>
    </div>
@endsection
