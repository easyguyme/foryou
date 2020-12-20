@extends('layouts.admin')
@section('content')

    <style>
        .card {
            margin-bottom: 1rem;
        }
        .list-view .row > [class*='col-'] {
            max-width: 100%;
            flex: 0 0 100%;
        }
        .list-view .card {
            flex-direction: row;
        }
        @media (max-width: 575.98px) {
            .list-view .card {
                flex-direction: column;
            }
        }
        .list-view .card > .card-img-top {
            width: auto;
            /*height: 10px;*/
        }
        .list-view .card .card-body {
            display: inline-block;
        }


    </style>


    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">
                {{ __('Program  Details') }}
            </h4>
        </div>

        <div class="card-body">
            <a style="margin-top:20px;" class="btn btn-info btn-sm float-right" href="{{ url()->previous() }}">
                {{ __('global.back_to_list') }}
            </a>
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

            </div>


        </div>
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">

                    {{ __("Program's Exercises") }}
                </h4>
            </div>

            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 my-3">
                            <div class="float-right">
                                <div class="">
                                    @can('program_edit')
                                        <a class="btn  btn-success" href="{{ route('admin.programs.getId', $program->id) }}">
                                            <i class="fas fa-plus"> Add Exercises</i>
                                        </a>
                                    @endcan
                                        @can('program_delete')
                                    <button class="btn btn-danger btn-list" id="btn-delete">
                                            <i class="fas fa-trash"> Delete Selected</i>
                                        </button>
                                        @endcan
                                    <button class="btn btn-info btn-list" id="list">
                                       <i class="fas fa-list"></i>
                                    </button>
                                    <button class="btn btn-danger btn-grid" id="grid">
                                        <i class="fa fa-th" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container grid-container">
                        <div class="row">
                            @foreach($exercises as $key => $exercise)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card">
                                    <a href="{{ route('admin.exercises.show', $exercise) }}"><img class="card-img-top" src="{{ $exercise->getMedia('exercises')[0]->getUrl('thumb')}}" alt="Card image cap"></a>
                                    <div class="card-body">
                                        <a href="{{ route('admin.exercises.show', $exercise) }}"><h5 class="card-title">{{ $exercise->name}}</h5></a>
                                        <p class="card-text">{{$exercise->description}}.</p>
                                        <input type="checkbox" class="checkbox" name="check[]" id="check[]" value="{{$exercise->id}}" />
                                    </div>
                                </div>
                            </div>
                            @endforeach
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

        $(function(){

            $('#btn-delete').click(function(){

                if(confirm("Are you sure you want to delete this?"))
                {
                    var id = [];

                    $(':checkbox:checked').each(function(i){
                        id[i] = $(this).val();
                    });

                    if(id.length === 0) //tell you if the array is empty
                    {
                        alert("Please Select at least one exercise");
                    }
                    else
                    {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: '{{ route('admin.programs.massDelete') }}',
                            data: { id:id, _method: 'DELETE'}})
                            .done(function (response) {
                                console.log(response);
                                swal({
                                    title: "Success!!",
                                    text: response.message,
                                    type: "success",
                                    showConfirmButton: false,

                                });

                                location.reload()
                            });
                    }

                }
                else
                {
                    return false;
                }
            });

        });


        function showList(e) {
            var $gridCont = $('.grid-container');
            e.preventDefault();
            $gridCont.hasClass('list-view') ? $gridCont.removeClass('list-view') : $gridCont.addClass('list-view');
        }
        function gridList(e) {
            var $gridCont = $('.grid-container');
            e.preventDefault();
            $gridCont.removeClass('list-view');
        }

        $(document).on('click', '.btn-grid', gridList);
        $(document).on('click', '.btn-list', showList);

    </script>
@endsection
