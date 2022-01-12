@extends('layouts.admin')
@section('content')
@can('nhif_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.nhif.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.nhif.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.nhif.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-nhif">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.nhif.fields.id_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.nhif.fields.nhif_amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.nhif.fields.transaction_code') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nhif as $nhif)
                        <tr>
                            <td>

                            </td>
                            <td>
                                {{ $nhif->user->id_no ?? '' }}
                            </td>
                            <td>
                                {{ $nhif->amount ?? '' }}
                            </td>
                            <td>
                                {{ $nhif->transaction_code ?? '' }}
                            </td>

                            <td>

                                @can('nhif_application_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.nhif.show', $nhif->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
{{--
                                @if(Gate::allows('nhif_application_edit') && in_array($nhif->status_id, [6,7]))
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.nhif-applications.edit', $nhif->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endif --}}

                                @can('nhif_application_delete')
                                    <form action="{{ route('admin.nhif.destroy', $nhif->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('nhif_application_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.nhif-applications.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-nhif:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
