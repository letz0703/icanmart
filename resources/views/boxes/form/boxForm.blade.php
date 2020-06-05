<form action="/boxes" method="POST">
    @csrf
    <div class="mb-4">
        <label for="seller_id">구입처 :</label>
        <select name="seller_id" id="seller_id"
                required>
            <option value="">선택</option>
            @foreach( $sellers as $seller )
                <option value="{{ $seller->id }}"
                    {{ old('seller_id') == $seller->id ? 'selected' : '' }}
                >{{ $seller->description }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label for="arrived_at">입고일: </label>

        <input type="date" id="arrived_at" name="arrived_at"
               class="border p-1"
               {{--value="{{ old('arrive_at') }}"--}}
               value="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
            {{--placeholder="{{ \Carbon\Carbon::today() }}"--}}
        >
    </div>
    <div class="mb-4">
        <label for="title" class="block">박스요약</label>
        <textarea type="text" id="title" name="title"
                  class="w-full md:bg-white"
                  rows="3"
                  value="{{ old('title') }}" required>
                        </textarea>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="paid" id="paid" value=1>
        <label class="form-check-label" for="paid">
            결제완료
        </label>
    </div>
    <div class="form-check form-check-inline form-group">
        <input class="form-check-input" type="radio" name="paid" id="paid" value=0 checked>
        <label class="form-check-label" for="upaid">
            미결제
        </label>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">add</button>
    </div>
</form>
