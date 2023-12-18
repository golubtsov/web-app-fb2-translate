<div>
    <div class="my-5 gap-2 w-full flex flex-col border p-4">
        <div>
            <p>
                <button id="{{$book->id}}" class="btn-book-title text-xl hover:text-amber-400">{{$book->title}}</button>
            </p>
        </div>
        <div>
            <p class="font-bold">Автор - {{$book->author}}</p>
        </div>
        <div>
            <p id="book-description-{{$book->id}}" class="hidden outline-2"></p>
        </div>
        <div>
            @if(is_null($book->translate))
                <button id="{{$book->id}}" class="btn-translate border p-2 hover:text-white hover:bg-amber-400">Создать перевод</button>
            @else
                <p>{{$book->translate->zip_name}}</p>
                <a
                    href="{{route('translate.download', ['id' => $book->translate->id])}}"
                    class="bg-amber-500 px-3 py-1 block w-fit mt-2 text-white hover:bg-amber-600"
                >Скачать</a>
            @endif
        </div>
    </div>
</div>
