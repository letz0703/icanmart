{{--@php--}}
{{--use App\Item;--}}
{{--$items = Item::latest()->get();--}}
{{--@endphp--}}

<div class="container">
    <h3>최근 아이템 목록</h3>
    @foreach($items as $item)
        <p>
            <a href="{{$item->path()}}">
                {{ $item->product_name }} / 판매가 {{ $item->sell_price }}/
                입고일: {{ $item->created_at->format('Y-m-d') }}
            </a>
        </p>
    @endforeach
</div>
