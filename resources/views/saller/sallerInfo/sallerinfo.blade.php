@extends('layouts.sallerDashboard')

@section('title')
    <title>Artisan Hub | Saller</title>
@endsection

@section('content')
    @include('layouts.alerts')
    <h2>Saller Info</h2>

    <div class="row">
        <div class="col-xl-8 col-lg-12">
            <!-- project card -->
            <div class="card d-block">
                <div class="card-body">
                    @if ($sallerInfo)
                        <div class="dropdown float-right">
                            <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown"
                                aria-expanded="false">
                                <i class='mdi mdi-dots-horizontal font-18'></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">

                                <!-- item-->
                                <a href="#" class=" edit-category-link" data-toggle="modal"
                                    data-target="#editCategoryModal" data-category-id="{{ $sallerInfo->id }}">
                                    <i class="mdi mdi-square-edit-outline"></i>Edit
                                </a>
                            </div> <!-- end dropdown menu-->
                        </div> <!-- end dropdown-->
                        <h4>Saller Info</h4>
                        <h5 class="mt-3">Id: <span>{{ $sallerInfo->saller_id }}</span></h5>

                        <h5 class="mt-3">Name: <span>{{ Auth::guard('sallers')->user()->name }}</span></h5>
                        <h5 class="mt-3">Email: <span>{{ Auth::guard('sallers')->user()->email }}</span></h5>
                        <h5 class="mt-3">Phone: <span>{{ $sallerInfo->phone }}</span></h5>
                        <h5 class="mt-3">Address: <span>{{ $sallerInfo->address }}</span></h5>

                        {{--  <!-- Display NID images if they exist -->  --}}
                        @if ($sallerInfo->nid)
                            <h5 class="mt-3">NID Images:</h5>
                            <div class="row">
                                @foreach (json_decode($sallerInfo->nid) as $image)
                                    <div class="col-md-3">
                                        <img src="{{ asset($image) }}" class="img-fluid" alt="NID Image">
                                    </div>
                                @endforeach
                            </div>
                        @endif


                        {{--  <!-- Add edit option here if needed -->  --}}
                    @else
                        <h5>No Saller Info found.</h5>
                        <h4>Add Saller Info</h4>

                        <form action="{{ route('sallerinfo.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="phone">Phone Number</label>
                                <input type="number" id="phone" name="phone" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="5"></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="nid">NID upload</label>
                                <input type="file" id="nid" name="nid[]" class="form-control-file" multiple>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    @endif

                </div> <!-- end card-body-->
            </div> <!-- end card-->
            <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->

    @if ($sallerInfo)
        <!-- Edit Category Modal -->
        <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog"
            aria-labelledby="editCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCategoryModalLabel">Edit Saller Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editCategoryForm" action="{{ route('sallerinfo.update', $sallerInfo->id) }}"
                            method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="phone">Phone Number</label>
                                <input type="number" id="phone" name="phone" class="form-control"
                                    value="{{ $sallerInfo->phone }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="5">{{ $sallerInfo->address }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nid">NID upload</label>
                                <input type="file" id="nid" name="nid[]" class="form-control-file" multiple>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="editCategoryBtn">Edit
                                    Saller Info</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
