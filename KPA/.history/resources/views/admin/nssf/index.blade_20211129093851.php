@extends('layouts.admin')
@section('content')
@can('nssf_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.nssf.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.nssf.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.nssf.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-nssf">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.nssf.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.nssf.fields.id_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.nssf.fields.nssf_amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.nssf.fields.transaction_code') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nssfs as $key => $nssf)
                        <tr data-entry-id="{{ $nssf->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $nssf->id ?? '' }}
                            </td>
                            <td>
                                {{ $nssf->id_no ?? '' }}
                            </td>
                            <td>
                                {{ $nssf->nssf_amount ?? '' }}
                            </td>
                            <td>
                                {{ $nssf->transaction_code ?? '' }}
                            </td>

                            <td>

                                @can('nssf_application_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.nssf.show', $nssf->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
{{--
                                @if(Gate::allows('nssf_application_edit') && in_array($nssf->status_id, [6,7]))
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.nssf-applications.edit', $nssf->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endif --}}

                                @can('nssf_application_delete')
                                    <form action="{{ route('admin.nssf-.destroy', $nssf->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('nssf_application_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.nssf-applications.massDestroy') }}",
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
  let table = $('.datatable-nssf:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
