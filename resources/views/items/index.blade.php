@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Items</div>
                    <div class="card-body">
                        <form action="/items?barcode=">
                            <div class="form-group">
                                <label for="barcode">바코드</label>
                                <input type="text" id="barcode" name="barcode" focus>
                                <button type="submit" class="btn btn-primary btn-sm">검색</button>
                                <button class="btn-sm"><a href="/items"> 전체보기 </a></button>
                            </div>
                            <hr>
                        </form>

                        @foreach($items as $item)
                            <article>
                                <div class="level">
                                    <img src="{{ $item->image_path }}" width="40" height="40"
                                         class="mr-2"
                                    >
                                    <a href="{{ $item->path() }}" class="flex">
                                        <h5>{{ $item->product_name }} ({{ $item->seller->name }}
                                            ) {{ $item->created_at->format('Y-m-d H:i:s' ) }}</h5>
                                    </a>
                                    <div> 바코드 : {{ $item->barcode }} </div>

                                </div>
                                <div>{{ $item->quantity }} x {{ $item->buy_price }} = {{ $item->amount }} 원</div>
                            </article>
                            <hr>

                            @if(request('barcode'))
                            <div>현재고: {{ $item->inventoryQuantity() }}</div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    window.onload = function() {
        document.getElementById("barcode").focus();
    };
</script>
