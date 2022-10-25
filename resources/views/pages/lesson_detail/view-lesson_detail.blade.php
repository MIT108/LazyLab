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
                    <h5 class="modal-title" id="exampleModalLabel">update {{ $lesson_detail->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/update-lesson_detail" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">


                        <div class="modal-body">
                            <div class="form-group">
                                <img src="{{ $lesson_detail->image }}" class="img-fluid border-radius-lg">

                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name-name" class="col-form-label">Description:</label>
                                <textarea type="text" class="form-control" name="description" id="name-name" required>{{ $lesson_detail->description }}</textarea>
                            </div>
                        </div>
                        <input type="text" name="lesson_detail_id" value="{{ $lesson_detail->id }}" required hidden>
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
                    <h5 class="modal-title" id="exampleModalLabel">Add Lesson</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/create-lesson" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">


                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name-name" class="col-form-label">Name:</label>
                                <input type="text" class="form-control" name="name" id="name-name">
                            </div>
                        </div>


                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name-name" class="col-form-label">Description:</label>
                                <textarea type="text" class="form-control" name="description" id="name-name" required></textarea>
                            </div>
                        </div>
                        <input type="text" name="lesson_detail_id" value="{{ $lesson_detail->id }}" required hidden>
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
                        <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill flex-column p-1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab"
                                        href="#definition" role="tab" aria-controls="preview"
                                        aria-selected="true">
                                        Definitions
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab"
                                        href="#course" role="tab" aria-controls="code"
                                        aria-selected="false">
                                        Course
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab"
                                        href="#video" role="tab" aria-controls="code"
                                        aria-selected="false">
                                        Video
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab"
                                        href="#activities" role="tab" aria-controls="code"
                                        aria-selected="false">
                                        Activities
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab"
                                        href="#quiz" role="tab" aria-controls="code"
                                        aria-selected="false">
                                        Quiz
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div id="definition" class="tab-pane fade active show">

                                <div class="row">
                                    <div class="col-12">
                                        <h1>Definition</h1>
                                        <h6>{{ $lesson_detail->definition }}</h6>
                                        <br>

                                        <form action="/edit-definition-lesson-detail" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">

                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="name-name" class="col-form-label">Definition:</label>
                                                        <textarea type="text" class="form-control" name="definition" id="name-name" required>{{ $lesson_detail->definition }}</textarea>
                                                    </div>
                                                </div>
                                                <input type="text" name="lesson_detail_id" value="{{ $lesson_detail->id }}" required hidden>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn bg-gradient-primary">edit</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>


                            <div id="course" class="tab-pane fade">

                                <div class="row">
                                    <div class="col-12">
                                        <h1>Course</h1>
                                        <h6>{{ $lesson_detail->course }}</h6>
                                        <br>

                                        <form action="/edit-course-lesson-detail" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">

                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="name-name" class="col-form-label">Course:</label>
                                                        <textarea type="text" class="form-control" name="course" id="name-name" required>{{ $lesson_detail->course }}</textarea>
                                                    </div>
                                                </div>
                                                <input type="text" name="lesson_detail_id" value="{{ $lesson_detail->id }}" required hidden>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn bg-gradient-primary">edit</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>


                            <div id="video" class="tab-pane fade">

                                <div class="row">
                                    <div class="col-12">
                                        <iframe width="100%" height="400" src="{{ $lesson_detail->video }}" frameborder="0" allowfullscreen></iframe>
                                        <br>

                                        <form action="/edit-video-lesson-detail" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">

                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="name-name" class="col-form-label">Video:</label>
                                                        <textarea type="text" class="form-control" name="video" id="name-name" required>{{ $lesson_detail->video }}</textarea>
                                                    </div>
                                                </div>
                                                <input type="text" name="lesson_detail_id" value="{{ $lesson_detail->id }}" required hidden>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn bg-gradient-primary">edit</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>


                            <div id="Activities" class="tab-pane fade">

                                <div class="row">
                                    <div class="col-12">
                                        Activities
                                    </div>
                                </div>
                            </div>


                            <div id="quiz" class="tab-pane fade">

                                <div class="row">
                                    <div class="col-12">
                                        quiz
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="card h-100 p-3">
                        <div class="card-header">
                            <img src="{{ $lesson_detail->image }}" class="img-fluid border-radius-lg">
                        </div>
                        <div class="card-body px-0 pt-4">
                            <h4>
                                Heading: {{ $lesson_detail->head }}
                            </h4>
                            <p>
                                Athor: {{ $lesson_detail->author }}
                            </p>
                            <div class="font-sm">
                                Created Date: {{ $lesson_detail->created_at }}
                            </div>
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


            $('#image2').change(function() {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });

        });
    </script>
@endsection
