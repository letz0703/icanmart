<ul>
    <li>
        <div class="level">
        <div class="flex">
            {{ $item->product_name }} {{ $item->quantity }}개
            X {{ $item->buy_price }} : {{ $item->amount }}
        </div>
        <div>
            <form action="{{ $box->path() }}/{{$item->id}}" method="post">
                @csrf
                {{ method_field('delete') }}
                <button type="submit" class="btn btn-danger btn-sm">delete</button>
            </form>
        </div>
        </div>
    </li>
</ul>
