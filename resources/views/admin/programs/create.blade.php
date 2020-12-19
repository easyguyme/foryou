@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="card ">
                    <div class="card-header card-header-primary">


                        <h4 class="card-title">{{ __('Create a Program') }}</h4>
                        {{--                                <p class="card-category"> {{ __('You can separate them using a comma e.g Chair,Ball') }}</p>--}}
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-danger" style="display:none"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="{{ route('admin.programs.index') }}"
                                   class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Program name:') }}</label>
                            <div class="col-sm-7">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" id="input-name" type="text"
                                           placeholder="{{ __('Program name') }}" value="{{ old('name') }}"
                                           required="true" aria-required="true"/>
                                    @if ($errors->has('name'))
                                        <span id="name-error" class="error text-danger"
                                              for="input-name">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Descriptions:') }}</label>
                            <div class="col-sm-7">
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                            <textarea
                                                    class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                    name="description" id="input-description" type="text"
                                                    placeholder="{{ __('Program description') }}"
                                                    value="{{ old('description') }}"
                                                    required="true" aria-required="true" value="{{ old('description') }}" rows="3"></textarea>
                                    @if ($errors->has('description'))
                                        <span id="description-error" class="error text-danger"
                                              for="input-description">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Tags:') }}</label>
                            <div class="col-sm-7">
                                <div class="form-group{{ $errors->has('tags') ? ' has-danger' : '' }}">
                                    <input
                                            class="form-control{{ $errors->has('tags') ? ' is-invalid' : '' }}"
                                            name="tags" id="input-tags" type="text"
                                            placeholder="{{ __('Program tags') }}"
                                            value="{{ old('tags') }}"
                                            required="true" aria-required="true"/>
                                    @if ($errors->has('tags'))
                                        <span id="tags-error" class="error text-danger"
                                              for="input-tags">{{ $errors->first('tags') }}</span>
                                    @endif
                                </div>
                            </div>
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
                url: "{{ route('admin.programs.massAdd') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var exercise_id = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });
                    var name = $("#input-name").val();
                    var desc = $("#input-description").val();
                    var tags = $("#input-tags").val();
                    if (exercise_id.length === 0) {
                        alert('{{ __('No exercise was selected') }}');

                        return
                    }
                    if (name ==="" ) {
                        alert('{{ __('Program name required') }}');

                        return
                    }
                    if (desc ==="" ) {
                        alert('{{ __('Program description required') }}');

                        return
                    }
                    if (tags ==="" ) {
                        alert('{{ __('Program tags required') }}');

                        return
                    }
                    if (confirm('{{ __('Assign these exercises to the program?') }}')) {

                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: { exercise_id:exercise_id,name: name,description:desc,tags:tags, _method: 'POST' }})
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
            }
            dtButtons.push(deleteButton)
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
