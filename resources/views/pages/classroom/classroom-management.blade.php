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
                    <form action="/create-classroom" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Input classroom informations</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="file" required name="image" placeholder="Choose image" id="image"
                                        hidden>
                                </div>
                            </div>
                            <label for="image" class="text-center" style="width: 100%">
                                <div class="col-md-12 mb-2 imagePreviewWrapper">
                                    <img id="preview-image-before-upload" src="../assets/default/defaultImage.png"
                                        alt="preview image" style="max-height: 250px;">
                                </div>
                            </label>
                            <div class="form-group">
                                <label for="name-name" class="col-form-label">Name:</label>
                                <input type="text" class="form-control" name="name" id="name-name" required>
                            </div>
                            <div class="form-group">
                                <label for="email-name" class="col-form-label">Description:</label>
                                <textarea type="email" class="form-control" name="description" id="email-name" required></textarea>
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
                                <h5 class="mb-0">All Users</h5>
                            </div>
                            <div class="col-4">

                            <a type="button" class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal"
                                data-bs-target="#exampleModalMessage">+&nbsp; New Classroom</a>
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
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Photo
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            status
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
                                    @foreach ($classrooms as $classroom)
                                        <tr>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0">{{ $classroom->id }}</p>
                                            </td>
                                            <td>
                                                <div>
                                                    @if ($classroom->image == env('APP_URL') . '/storage/profile_image/')
                                                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                                                    @else
                                                        <img src="{{ $classroom->image }}" class="avatar avatar-sm me-3">
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $classroom->name }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $classroom->status }}</p>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $classroom->created_at }}</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="/classroom/{{ $classroom->id }}" class="mx-3" data-bs-toggle="tooltip"
                                                    data-bs-original-title="View classroom">
                                                    <i class="fas fa-eye text-secondary"></i>
                                                </a>
                                                @if ($classroom->status == 'active')
                                                    <a href="/classroom/suspend/{{ $classroom->id }}" class="mx-3"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-original-title="Suspend classroom">
                                                        <i class="fas fa-ban text-secondary"></i>
                                                    </a>
                                                @elseif ($classroom->status == 'inactive')
                                                    <a href="/classroom/activate/{{ $classroom->id }}" class="mx-3"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-original-title="activate classroom">
                                                        <i class="fas fa-check text-secondary"></i>
                                                    </a>
                                                @endif
                                                <a href="/classroom/delete/{{ $classroom->id }}" class="mx-3" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Delete classroom">
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
{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}


<script type="text/javascript">
    $(document).ready(function(e) {


        $('#image').change(function() {

            let reader = new FileReader();

            reader.onload = (e) => {

                $('#preview-image-before-upload').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });

    });
    $(document).ready(function() {
        $('#customers').DataTable();
    });
</script>
@endsection

