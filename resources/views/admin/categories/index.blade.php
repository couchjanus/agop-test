@extends('layouts.admin')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.categories.create") }}">Add category</a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        Categories List
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $key => $category)
                        <tr data-entry-id="{{ $category->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $category->name ?? '' }}
                            </td>
                            
                            <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.categories.show', $category->id) }}">
                                        view
                                    </a>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.categories.edit', $category->id) }}">
                                        edit
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are You Sure?');" style="display: inline-block;">
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
@endsection
@push('scripts')

<script>

$(function () {
  
  let deleteButton = {
    text: 'Delete',
    url: "{{ route('admin.categories.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('Zero Selected')
        return
      }

      if (confirm('Are You Sure?')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons, pageLength: 10 })
})

</script>
@endpush