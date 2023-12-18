<div class="mt-5 w-full border-b-4 border-gray-700">
    <h1 class="text-3xl">
        @if(route('main'))
            <a href="{{route('main')}}" class="hover:text-gray-400">Уровни</a> /
        @endif
        <span>{{$title}}</span>
    </h1>
</div>
