@csrf
<div class="form-group">
    <label for="name">Name:</label>
    <input type="text" class="form-control" id="name" name="name"
           value="{{ old('name',$seller->name) }}" required>
</div>
<div class="form-group">
    <label for="description">Description:</label>
    <input type="text" class="form-control" id="description" name="description"
           value="{{ old('description, $seller->description') }}" requried>
</div>

<div class="form-group">
    <label for="phone">Phone:</label>
    <input type="text" class="form-control" id="phone" name="phone"
           value="{{ old('phone', $seller->phone) }}"
    >
</div>

<div class="form-group">
    <button type="submit" class="btn btn-link btn-sm">{{ $buttonText ?? 'Add Seller' }}</button>
</div>

@if (count($errors))
    <ul class="alert alert-danger">
        @foreach( $errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
