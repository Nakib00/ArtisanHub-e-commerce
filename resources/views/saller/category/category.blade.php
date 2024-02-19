@extends('layouts.sallerDashboard')

@section('title')
    <title>Artisan Hub | Saller</title>
@endsection

@section('content')
    {{--  <!-- Start Content-->  --}}
    <div class="container-fluid">
        {{--  Show alerts  --}}
        @include('layouts.alerts')

        {{--  <!-- start page title -->  --}}
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Artisan Hub</a></li>
                            <li class="breadcrumb-item active">Category</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Category</h4>
                </div>
            </div>
        </div>
        {{--  <!-- end page title -->  --}}

        <div class="row">
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-lg-4">
                                        <div class="text-lg-right">
                                            <div class="container mt-5">
                                                <button type="button"
                                                    class="btn btn-danger waves-effect waves-light mb-2 mr-2"
                                                    data-toggle="modal" data-target="#addCategoryModal"><i
                                                        class="mdi mdi-basket mr-1"></i> Add Category</button>
                                            </div>
                                        </div>
                                    </div><!-- end col-->
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap mb-0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Category ID</th>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th style="width: 125px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categorys as $category)
                                                <tr>
                                                    <td><a href="ecommerce-order-detail.html"
                                                            class="text-body font-weight-bold">{{ $category->id }}</a>
                                                    </td>
                                                    <td>
                                                        {{ $category->name }}
                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($category->created_at)->format('j F Y') }}
                                                    </td>
                                                    <td>
                                                        @if ($category->status == '1')
                                                            <a
                                                                href="{{ route('saller.category.status', ['id' => $category->id, 'status' => '0']) }}">
                                                                <span class="badge badge-success">Active</span>
                                                            </a>
                                                        @else
                                                            <a
                                                                href="{{ route('saller.category.status', ['id' => $category->id, 'status' => '1']) }}">
                                                                <span class="badge badge-danger">Inactive</span>
                                                            </a>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        <a href="#" class="action-icon edit-category-link"
                                                            data-toggle="modal" data-target="#editCategoryModal"
                                                            data-category-id="{{ $category->id }}">
                                                            <i class="mdi mdi-square-edit-outline"></i>Edit
                                                        </a>

                                                        <form action="{{ route('saller.category.delete', $category->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link action-icon">
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{--  <!-- end card-body-->  --}}
                        </div>
                        {{--  <!-- end card-->  --}}
                    </div>
                    {{--  <!-- end col -->  --}}
                </div>
                <! {{--  -- end row -->  --}} </div>
                    {{--  <!-- container -->  --}}
            </div>
            {{--  <!-- end row -->  --}}

        </div>
        {{--  <!-- container -->  --}}

        {{--  <!-- Add Category Modal -->  --}}
        <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addCategoryForm" action="{{ route('saller.category.add') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="categoryName">Name</label>
                                    <input type="text" class="form-control" id="categoryName" name="name">
                                </div>
                                <div class="form-group">
                                    <label>Status</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="activeStatus"
                                            value="1" checked>
                                        <label class="form-check-label" for="activeStatus">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inactiveStatus"
                                            value="0">
                                        <label class="form-check-label" for="inactiveStatus">Inactive</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="addCategoryBtn">Add Category</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>


        <!-- Edit Category Modal -->
        <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog"
            aria-labelledby="editCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editCategoryForm" action="{{ route('saller.category.update', $category->id) }}"
                            method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="editCategoryName">Name</label>
                                <input type="text" class="form-control" id="editCategoryName" name="name"
                                    value="{{ $category->name }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="editCategoryBtn">Edit
                                    Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
