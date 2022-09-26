@extends('layouts.user_type.auth')

@section('content')
{{-- datatable --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />


    {{-- //modals --}}

    <div class="col-md-4">
        <!-- Button trigger modal -->
        {{-- <button type="button" class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal" data-bs-target="#exampleModalMessage">
      Message Modal
    </button> --}}

        <!-- Modal -->
        <div class="modal fade" id="exampleModalMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="/create-objective" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Input objective informations</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name-name" class="col-form-label">Objective:</label>
                                <textarea type="text" class="form-control" name="name" id="name-name" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn bg-gradient-primary">Create</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div class="col-4">
                                <h5 class="mb-0">All Objective</h5>
                            </div>
                            <div class="col-4">

                            <a type="button" class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal"
                                data-bs-target="#exampleModalMessage">+&nbsp; New Objective</a>
                            </div>

                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-3">
                            <table class="table align-items-center mb-0 p-3" id="customers">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ID
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            objective
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Creation Date
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($objectives as $objective)
                                        <tr>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0">{{ $objective->id }}</p>
                                            </td>
                                            <td class="">
                                                <p class="text-xs font-weight-bold mb-0">{{ $objective->name }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $objective->created_at }}</p>
                                            </td>
                                            <td class="text-center">
                                                <a href="/objective/delete/{{ $objective->id }}" class="mx-3" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Delete objective">
                                                    <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                                </a>
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


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="../../assets/js/plugins/datatables.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#customers').DataTable();
    });
</script>
@endsection
