@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
        Edit brand
    </div>

    <div class="card-body">
        <form action="{{ route("admin.brands.update", $brand->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Name *</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($brand) ? $brand->name : '') }}">
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block">
                    
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="Save">
            </div>
        </form>
    </div>
</div>
@endsection
