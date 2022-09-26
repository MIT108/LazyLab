@extends('layouts.user_type.auth')

@section('content')
    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />


    {{-- Modals --}}

    {{-- create new ingredient modal --}}
    <div class="modal fade" id="editIngredient" tabindex="-1" role="dialog" aria-labelledby="editIngredientTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">update a offer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/update-offer" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name-name" class="col-form-label">Name:</label>
                                <input type="text" class="form-control" name="name" value="{{ $offer->name }}"   id="name-name" required>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name-name" class="col-form-label">Price:</label>
                                <input type="number" class="form-control" name="price" value="{{ $offer->price }}" id="name-name">
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name-name" class="col-form-label">Description:</label>
                                <textarea type="text" class="form-control" name="description" id="name-name" required>{{ $offer->description }}</textarea>
                            </div>
                        </div>
                        <input type="text" name="offer_id" value="{{ $offer->id }}" required hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    {{-- add ingredient modal --}}
    <div class="modal fade" id="addIngredient" tabindex="-1" role="dialog" aria-labelledby="addIngredientTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add offer Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/offer-detail" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name-name" class="col-form-label">Name:</label>
                                <input type="text" class="form-control" name="name"  id="name-name">
                            </div>
                        </div>
                        <input type="text" name="offer_id" value="{{ $offer->id }}" required hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Add</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12 col-xl-8">
                    <div class="card h-100 p-3">
                        <div class="card-body px-0 pt-4">
                            <h4>
                                Name: {{ $offer->name }}
                            </h4>
                            <p>
                                Price: {{ $offer->price }}
                            </p>
                            <p>
                                Recommended:
                                @if ($offer->recommended == 0)
                                    <a href="/recommend-offer/{{ $offer->id }}">
                                        <button class="btn btn-danger">Not recommended</button>
                                    </a>
                                @else
                                    <button class="btn btn-success" disabled>Recommended</button>
                                @endif
                            </p>
                            <p>
                                Description: {{ $offer->description }}
                            </p>
                            <div class="font-sm">
                                Created Date: {{ $offer->created_at }}

                            </div>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#editIngredient"
                                class="btn bg-gradient-primary mt-3">Edit</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-lg-6 col-7">
                                    <h6>Offer Detail</h6>
                                </div>
                                <div class="col-lg-6 col-5 my-auto text-end">
                                    <a href="#" class="btn bg-gradient-primary btn-sm mb-3" type="button"
                                        data-bs-toggle="modal" data-bs-target="#addIngredient">+&nbsp; add offer detail</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                @foreach ($offer['offer_detail'] as $offer_detail)
                                    <li class="list-group-item border-0 d-flex align-items-center px-0 ">
                                        <div class="d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="mb-0 ">{{ $offer_detail->name }}</h6>
                                            <p class="mb-0 text-xs">{{ $offer_detail->created_at }}</p>
                                        </div>
                                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">
                                            <a href="/delete-offer-detail/{{ $offer_detail->id }}" class="mx-3"
                                                data-bs-toggle="tooltip" data-bs-original-title="View indgredient">
                                                <button class="btn btn-danger">Delete</button>
                                            </a>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
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
            $('#ingredents').DataTable();
        });
    </script>

    <style>
        .imagePreviewWrapper {
            width: 100%;
            height: 250px;
            display: block;
            cursor: pointer;
            margin: 0 auto 30px;
            background-size: cover;
            background-position: center center;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
    </script>
@endsection
