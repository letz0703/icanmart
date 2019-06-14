@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Boxes</div>

                    <div class="card-body">
                        <form action="/boxes" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="writer">작성자: {{ auth()->user()->name }}</label>
                                <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                            </div>
                            <div class="form-group">
                                <label for="seller_id">구입처 :</label>
                                <select name="seller_id" id="seller_id" class="form-control" required>
                                    <option value="">선택</option>
                                    @foreach( $sellers as $seller )
                                        <option value="{{ $seller->id }}"
                                                {{ old('seller_id') == $seller->id ? 'selected' : '' }}
                                        >{{ $seller->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="arrived_at">입고일:</label>

                                <input type="date" id="arrived_at" name="arrived_at"
                                       {{--value="{{ old('arrive_at') }}"--}}
                                       value="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                                        {{--placeholder="{{ \Carbon\Carbon::today() }}"--}}
                                >
                            </div>
                            <div class="form-group">
                                <label for="title">박스요약:</label>
                                <input type="text" id="title" name="title"
                                       value="{{ old('title') }}"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="amount">금액:</label>
                                <input type="text" id="amount" name="amount" value="{{ old('amount') }}">원
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="paid" id="paid" value=1 checked>
                                <label class="form-check-label" for="paid">
                                    결제완료
                                </label>
                            </div>
                            <div class="form-check form-check-inline form-group">
                                <input class="form-check-input" type="radio" name="paid" id="paid" value=0>
                                <label class="form-check-label" for="upaid">
                                    미결제
                                </label>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">add</button>
                            </div>
                            @if (count($errors))
                                <ul class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
