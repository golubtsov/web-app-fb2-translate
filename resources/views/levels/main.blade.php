@extends('layouts.app')

@section('content')
    <div>
        <x-titles.main-title/>
        <div class="mt-5">
            @foreach($levels as $level)
                <div>
                    <a href="{{route('level.books', ['level' => implode('-', explode(' ', strtolower($level->name)))])}}">{{$level->name}}</a>
                </div>
                <br>
            @endforeach
        </div>
    </div>
@endsection
