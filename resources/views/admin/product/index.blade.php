@php
    use Carbon\Carbon;
@endphp
@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title', 'Users List')
{{-- vendor styles --}}
@section('vendor-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
@endsection
{{-- page styles --}}
@section('page-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/app-users.css') }}">
@endsection
@section('content')
    <!-- users list start -->
    <section class="users-list-wrapper">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                        <a href="{{ route('admin.product.create') }}"
                            class="btn btn-info btn-block glow users-list-clear mb-0">Add Product</a>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="users-list-filter px-1">
            <form>
                <div class="row border rounded py-2 mb-2">
                    <div class="col-12 col-sm-6 col-lg-3">
                        <label for="users-list-verified">Verified</label>
                        <fieldset class="form-group">
                            <select class="form-control" id="users-list-verified">
                                <option value="">Any</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <label for="users-list-role">Role</label>
                        <fieldset class="form-group">
                            <select class="form-control" id="users-list-role">
                                <option value="">Any</option>
                                <option value="User">User</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <label for="users-list-status">Status</label>
                        <fieldset class="form-group">
                            <select class="form-control" id="users-list-status">
                                <option value="">Any</option>
                                <option value="Active">Active</option>
                                <option value="Close">Close</option>
                                <option value="Banned">Banned</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                        <button type="reset" class="btn btn-primary btn-block glow users-list-clear mb-0">Clear</button>
                    </div>
                </div>
            </form>
        </div> --}}
        <div class="users-list-table">
            <div class="card">
                <div class="card-body">
                    @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                    <!-- datatable start -->
                    <div class="table-responsive">
                        <table id="users-list-datatable" class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    {{-- <th>Image</th> --}}
                                    <th> Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>status</th>
                                    <th>edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        {{-- <td> <img class="img-view-ad"
                                                src="{{ asset('storage/file' . $item->id . '_' . $item->name) }}"
                                                title="{{ $item->viewPhoto->name }}" alt="{{ $item->viewPhoto->name }}" />
                                        </td> --}}
                                        <td><a
                                                href="{{ route('admin.product.edit', ['product' => $item->id]) }}">{{ $item->name }}</a>
                                        </td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->price }} BIF</td>

                                        <td><span class="badge badge-light-success">Active</span></td>
                                        <td class="d-flex">
                                            <a href="{{ route('admin.product.edit', ['product' => $item->id]) }}"><i
                                                    class="bx bx-edit-alt"></i></a>
                                            <form action="{{ route('admin.product.delete', ['product' => $item->id]) }}"
                                                method="post" style="margin: -4px 0px;">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" onclick="return(confirm('do you want to delete??'))"
                                                    class="btn" style="padding: 0; padding: 0 7px;">
                                                    <i class="bx bx-trash text-danger"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- datatable ends -->
                </div>
            </div>
        </div>
    </section>
    <!-- users list ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
    <script src="{{ asset('vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
    <script src="{{ asset('js/scripts/pages/app-users.js') }}"></script>
@endsection
