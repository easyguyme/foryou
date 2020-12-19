@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title">

                            {{ __(' Select Patient') }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Patient Name') }}</label>
                            <div class="col-sm-7">
                                <div class="form-group{{ $errors->has('user_id') ? ' has-danger' : '' }}">
                                    <select name="user_id" id="user_id" class="form-control select2" multiple="multiple" required>
                                        @foreach($users as  $key => $value)
                                            <option value="{{ $value }}">{{ $key }}</option>
                                            {{--                        <option value="{{ $value }}" {{ (in_array($id, old('user_id', [])) || isset($user) && $user->user_id->contains($id)) ? 'selected' : '' }}>{{ $user_id }}</option>--}}
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">

                            {{str_plural('Programs',$exercises->count())}} {{ __(' List') }}
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-striped table-hover datatable datatable-User">
                                <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>

                                    </th>

                                    <th>
                                        {{ __('Name') }}
                                    </th>
                                    <th>
                                        {{ __('Tags') }}
                                    </th>


                                    <th>
                                        &nbsp;
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($exercises as $key => $exercise)
                                    <tr data-entry-id="{{ $exercise->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            <strong>{{ $key+1 }}.</strong>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.exercises.show', $exercise) }}">{{ $exercise->name}}</a>
                                        </td>
                                        <td>
                                            {{ $exercise->tags }}
                                        </td>


                                        <td>
                                            @can('exercise_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.exercises.show', $exercise->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan



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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection
@section('scripts')
@parent


<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
@can('workout_create')
  let deleteButtonTrans = 'Add Selected';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.programs.massAdd') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var exercise_id = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });
        var user_id = $("#user_id").val();

      if (exercise_id.length === 0) {
            alert('{{ __('No exercise was selected') }}');

            return
        }
        if (user_id.length === 0) {
            alert('{{ __('Select a Patient first') }}');

            return
        }
      if (confirm('{{ __('Assign this program to the patient?') }}')) {

        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { exercise_id: exercise_id,user_id:user_id, _method: 'POST' }})
          .done(function (response) {
              console.log(response);
              swal({
                  title: "Success!!",
                  text: response.message,
                  type: "success",
                  showConfirmButton: false,

              });
              location.reload()
          })
      }
    }
  };
  dtButtons.push(deleteButton);
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
