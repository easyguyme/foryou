@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">
                {{ __('My Details') }}
            </h4>
        </div>

        <div class="card-body">

            <div class="mb-2">
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ __('ID') }}
                        </th>
                        <td>
                            P4U{{ $patient->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Name') }}
                        </th>
                        <td>
                            {{ $patient->user->name}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Email') }}
                        </th>
                        <td>
                            {{ $patient->user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Gender') }}
                        </th>
                        <td>
                            {{ $patient->gender }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Age') }}
                        </th>
                        <td>
                            {{ $patient->age }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Phone') }}
                        </th>
                        <td>
                            {{ $patient->user->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Location') }}
                        </th>
                        <td>
                            {{ $patient->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Added by') }}
                        </th>
                        <td>
                            {{ $patient->created_by }}
                        </td>
                    </tr>

                    </tbody>
                </table>

            </div>


        </div>
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">

                    {{ __(' My Exercises') }}
                </h4>
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                                <span>{{ session('status') }}</span>
                            </div>
                        </div>
                    </div>
                @endif
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



                                    @can('workout_delete')
                                        <form action="{{ route('admin.workouts.destroy', $exercise->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    </div>


@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
                    @can('exercise_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'

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
