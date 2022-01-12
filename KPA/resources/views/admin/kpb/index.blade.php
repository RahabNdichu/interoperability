@extends('layouts.admin')
@section('content')
@can('kpb_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.kpb.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.kpb.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.kpb.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-kpb">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.kpb.fields.id_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.kpb.fields.kpb_amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.kpb.fields.transaction_code') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kpb as $kpb)
                        <tr>
                            <td>

                            </td>
                            <td>
                                {{ $kpb->user->id_no ?? '' }}
                            </td>
                            <td>
                                {{ $kpb->amount ?? '' }}
                            </td>
                            <td>
                                {{ $kpb->transaction_code ?? '' }}
                            </td>

                            <td>

                                @can('kpb_application_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.kpb.show', $kpb->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
{{--
                                @if(Gate::allows('kpb_application_edit') && in_array($kpb->status_id, [6,7]))
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.kpb-applications.edit', $kpb->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endif --}}

                                @can('kpb_application_delete')
                                    <form action="{{ route('admin.kpb.destroy', $kpb->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('kpb_application_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.kpb-applications.massDestroy') }}",
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
  let table = $('.datatable-kpb:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
