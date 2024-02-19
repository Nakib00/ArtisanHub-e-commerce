@extends('layouts.sallerDashboard')

@section('title')
    <title>Artisan Hub | Saller</title>
@endsection


@section('content')
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
                            <li class="breadcrumb-item active">Shop</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Shop</h4>
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
                                                        class="mdi mdi-basket mr-1"></i> Add Shop</button>
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
                                            {{--  @foreach ($categorys as $category)  --}}
                                                <tr>
                                                    <td><a href="ecommerce-order-detail.html"
                                                            class="text-body font-weight-bold">ee</a>
                                                    </td>
                                                    <td>
                                                        {{--  {{ $category->name }}  --}}ee
                                                    </td>
                                                    <td>
                                                        {{--  {{ \Carbon\Carbon::parse($category->created_at)->format('j F Y') }}  --}}ee
                                                    </td>
                                                    <td>
                                                        {{--  @if ($category->status == '1')  --}}
                                                            <a
                                                                href="">
                                                                <span class="badge badge-success">Active</span>
                                                            </a>
                                                        {{--  @else  --}}
                                                            <a
                                                                href="">
                                                                <span class="badge badge-danger">Inactive</span>
                                                            </a>
                                                        {{--  @endif  --}}

                                                    </td>
                                                    <td>
                                                        <a href="#" class="action-icon edit-category-link"
                                                            data-toggle="modal" data-target="#editCategoryModal"
                                                            data-category-id="">
                                                            <i class="mdi mdi-square-edit-outline"></i>Edit
                                                        </a>

                                                        <form action=""
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link action-icon">
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            {{--  @endforeach  --}}

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
    </div>
@endsection
