@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title', 'Bootstrap Tables')
@section('content')
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-between">
                    <h3 class="text-bold-700">Categories</h3>
                    <button type="button" class="btn btn-primary  mx-3 mt-2 mb-2" data-toggle="modal"
                        data-target="#modal-category">
                        <i class="bx bx-plus"></i> Category
                    </button>
                    @include('admin.category.create')
                    {{-- <a href="{{ route('group.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Access Group</a> --}}
                </div>
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <!-- Table with outer spacing -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>PARENT NAME</th>
                                    <th>CREATED DATE</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $item)
                                    <tr>
                                        <td class="text-bold-500">
                                            <a href="#" data-toggle="modal"
                                                data-target="#modal_category_edit{{ $item->id }}">
                                                {{ $item->name }}
                                            </a>
                                        </td>
                                        <td class="text-bold-500">
                                            @if ($item->parent_id !== null)
                                                {{ $item->chlidren->name }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td><span
                                                class="badge @if ($item->status == 'disponible') badge-light-success
                                        @elseif ($item->status == 'finished')
                                        badge-light-danger
                                        @else
                                        badge-light-warning @endif badge-pill">{{ $item->status }}</span>
                                        </td>
                                        <td class="d-flex">
                                            <button type="button" class="btn" data-toggle="modal"
                                                data-target="#modal_category_edit{{ $item->id }}">
                                                <i class="bx bxs-edit-alt"></i>
                                            </button>
                                            @include('admin.category.edit')
                                            <form action="{{ route('admin.category.delete', ['category' => $item->id]) }}"
                                                method="post" style="margin: 7px 0px;">
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
                </div>
            </div>
        </div>
    </div>
    <!-- Basic Tables end -->
@endsection
@section('vendor-scripts')
    <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
@endsection
{{-- page scrips --}}
@section('page-scripts')
    <script src="{{ asset('js/scripts/forms/select/form-select2.js') }}"></script>
@endsection
