@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Item</div>

                    <div class="card-body">
                        <form action="/items" method="POST">
                            @csrf
                            <div class="form-group">
                                <select class="form-control" id="seller_id" name="seller_id">
                                    <option selected>사입처 선택</option>
                                    <option value="1">수입</option>
                                    <option value="2">6층</option>
                                    <option value="3">중앙</option>
                                    <option value="4">보따리</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="barcode">Barcode:</label>

                                <input type="text" id="barcode" name="barcode" value="">
                            </div>
                            <div class="form-group">
                                <input type="hidden" id="user_id" name="user_id">
                            </div>

                            <div class="form-group">
                                <label for="product_name">아이템명:</label>
                                <input type="text" id="product_name" name="product_name">
                            </div>

                            <div class="form-group">
                                <label for="quantity">수량:</label>
                                <input type="text" id="quantity" name="quantity" placeholder="quantity">원
                            </div>

                            <div class="form-group">
                                <label for="expire_date">Expire_date:</label>
                                <input type="date" id="expire_date" name="expire_date">
                            </div>

                            <div class="form-group">
                                <label for="buy_price">Buy_price:</label>
                                <input type="text" id="buy_price" name="buy_price">
                            </div>

                            <div class="form-group">
                                <label for="sell_price">Sell_price:</label>
                                <input type="text" id="sell_price" name="sell_price">
                            </div>

                            <button type="submit" class="btn btn-default">add</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
