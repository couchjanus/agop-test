@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create product
    </div>

    <div class="card-body">
        <form action="{{ route("admin.products.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Name *</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($product) ? $product->name : '') }}">
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block"></p>
            </div>

            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" class="form-control" value="{{ old('price', isset($product) ? $product->price : '') }}" step="0.01">
                @if($errors->has('price'))
                    <p class="help-block">
                        {{ $errors->first('price') }}
                    </p>
                @endif
                <p class="helper-block"></p>
            </div>

            <div class="form-group">
                <label class="control-label" for="brand_id">Brand</label>
                <select name="brand_id" id="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
                    <option value="0">Select a brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                </select>
                <div class="invalid-feedback active">
                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('brand_id') <span>{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="categories">Categories</label>
                <select name="categories[]" id="categories" class="form-control" multiple>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>



            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control ">{{ old('description', isset($product) ? $product->description : '') }}</textarea>
                @if($errors->has('description'))
                    <p class="help-block">
                        {{ $errors->first('description') }}
                    </p>
                @endif
                <p class="helper-block"></p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="Save">
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $('#categories').select2();  
</script>
@endpush
