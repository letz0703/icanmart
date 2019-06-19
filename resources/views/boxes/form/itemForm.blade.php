<form action="{{ $box->path().'/items' }}" method="POST">
    @csrf
    <div class="form-group">
        <input type="hidden" id="seller_id" name="seller_id"
               value="{{ $box->seller->id }}"
        >
    </div>
    <div class="form-group">
        <input type="hidden" id="box_id" name="box_id"
               value="{{ $box->id }}"
        >
    </div>
    <div class="form-group">
        <label for="barcode">Barcode:</label>
        <input type="text" id="barcode" name="barcode">
    </div>
    <div class="form-group">
        <label for="product_name" required>제품명:</label>
        <input type="text" id="product_name" name="product_name">
    </div>
    <div class="form-group">
        <label for="quantity" required>수량:</label>
        <input type="text" id="quantity" name="quantity"> 개
    </div>
    <div class="form-group">
        <label for="buy_price">입고단가:</label>
        <input type="text" id="buy_price" name="buy_price"> 원
    </div>
    <div class="form-group">
        <label for="expire_date">Expire_date:</label>
        <input type="date" id="expire_date" name="expire_date"
               value="{{ Carbon\Carbon::now()->addMonth(6)->format('Y-m-d') }}"
        >
    </div>
    <button type=" submit" class="btn btn-primary btn-sm">add</button>
</form>