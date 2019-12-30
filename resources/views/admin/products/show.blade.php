@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Show product
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        Name
                    </th>
                    <td>
                        {{ $product->name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Description
                    </th>
                    <td>
                        {!! $product->description !!}
                    </td>
                </tr>
                <tr>
                    <th>
                        Price
                    </th>
                    <td>
                        ${{ $product->price }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection