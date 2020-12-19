@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">
                            {{ __('Program  Details') }}
                        </h4>
                    </div>

                    <div class="card-body">

                        <div class="mb-2">
                            <table class="table table-bordered table-striped">
                                <tbody>

                                <tr>
                                    <th>
                                        {{ __('Name') }}
                                    </th>
                                    <td>
                                        {{ $program->name}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ __('Description') }}
                                    </th>
                                    <td>
                                        {{ $program->description}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ __('Tags') }}
                                    </th>
                                    <td>
                                        {{ $program->tags }}
                                    </td>
                                </tr>




                                </tbody>
                            </table>
                            <input type="text" name="program_id" id="program_id" value="{{ $program->id }}" hidden>
                        </div>


                    </div>
                </div>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">

                            {{str_plural('Exercises',$exercises->count())}} {{ __(' List') }}
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
                    @can('program_create')
            let deleteButtonTrans = 'Add Selected';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.programs.massUpdate') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var exercise_id = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });
                    var program_id = $("#program_id").val();
                    var url2 = "{{ route('admin.programs.show',$program->id) }}"
                    if (exercise_id.length === 0) {
                        alert('{{ __('No exercise was selected') }}');

                        return
                    }

                    if (confirm('{{ __('Assign these exercises to the program?') }}')) {

                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: { exercise_id:exercise_id,program_id: program_id, _method: 'POST' }})
                            .done(function (response) {
                                console.log(response);
                                swal({
                                    title: "Success!!",
                                    text: response.message,
                                    type: "success",
                                    showConfirmButton: false,

                                });

                                window.location.href= url2;
                            })
                    }
                }
            }
            dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            });
            $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })

    </script>
@endsection
