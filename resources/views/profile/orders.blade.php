@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3 mb-3">
            @include('profile.partials._menu')
        </div>
        <div class="col-sm-9">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">My Orders</div>
                        <div class="card-body">

                            <table class=" table table-bordered table-striped table-hover datatable">
                                <thead>
                                    <tr>
                                        <th width="10">
                                            Id
                                        </th>
                                        <th>
                                            Grand total
                                        </th>
                                        <th>
                                            Date
                                        </th>
                                        <th>
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $key => $val)
                                    <tr>
                                        <td>
                                            {{ $val->id }}
                                        </td>
                                        <td>
                                            {{ $val->grand_total }}
                                        </td>
                                        <td>
                                            {{ $val->updated_at }}
                                        </td>
                                        <td>
                                            <a class="btn btn-xs btn-primary" href="">view</a>
                                            <a class="btn btn-xs btn-info" href="">edit</a>
                                            <form action="" method="POST" onsubmit="return confirm('Are You Sure?');"
                                                style="display: inline-block;">
                                                @csrf
                                                @method("DELETE")
                                                <input type="submit" class="btn btn-xs btn-danger" value="delete">
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
