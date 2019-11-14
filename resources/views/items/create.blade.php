@extends('layouts.app')

@section('content')
    <item-in inline-template>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Create Item</div>

                        <div class="card-body">
                            <form method="post" action="/items" @submit.prevent="onSubmit">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" id="user_id" name="user_id">
                                </div>

                                <div class="form-group">
                                    <label for="product_name" class="label">아이템명:</label>
                                    <input type="text" id="product_name" name="product_name"
                                           v-model="product_name"
                                           v-focus
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="description" class="label">설명:</label>
                                    <input type="text" id="description" name="description"
                                           v-model="description"
{{--                                           required--}}
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="quantity" class="label">수량:</label>
                                    <input type="text" id="quantity" name="quantity"
                                           v-model="quantity"
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="buy_price" class="label">구입가:</label>
                                    <input type="text" id="buy_price" name="buy_price"
                                           v-model="buy_price"
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="sell_price" class="label">판매가:</label>
                                    <input type="text" id="sell_price" name="sell_price"
                                           v-model="sell_price"
                                    >
                                </div>
{{--                                <input type="button" @keyup.enter="submit" value="add">--}}
{{--                                <button value="default" style="display: none;"></button>--}}

                                <div class="form-group">
                                    <label for="barcode" class="label">Barcode:</label>

                                    <input type="text" id="barcode" name="barcode"
                                           v-model="barcode"
                                    >
                                </div>
                                <button class="btn btn-outline-info">create</button>
                            </form>
                        </div>
                        <div class="">
                           @include('items._list')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </item-in>
@endsection
