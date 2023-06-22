@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title', 'Users List')
{{-- vendor styles --}}

@section('vendor-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/ui/prism.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/file-uploaders/dropzone.min.css') }}">
@endsection
{{-- page-styles --}}
@section('page-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/file-uploaders/dropzone.css') }}">
@endsection
@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Product</h4>
                    </div>
                    <div class="card-body">
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        <section class="multiple-select2">
                            <form class="form" action="{{ route('admin.product.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="text" id="first-name-column" name="name"
                                                    class="form-control @error('name')is-invalid @enderror"
                                                    placeholder="Name">
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('name') }}
                                                    </div>
                                                @enderror
                                                <label for="first-name-column">Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <select class="form-control @error('category_id') is-invalid @enderror"
                                                    name="category_id">
                                                    <option value="">Choice Category</option>
                                                    @foreach ($category as $item)
                                                        <optgroup label="{{ $item->name }}">
                                                            @foreach ($item->categories as $cat)
                                                                <option value="{{ $cat->id }}">{{ $cat->name }}
                                                                </option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('category_id') }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="number" id="city-column" name="quantity"
                                                    class="form-control @error('quantity') is-invalid @enderror"
                                                    placeholder="Quantity">
                                                @error('quantity')
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('quantity') }}
                                                    </div>
                                                @enderror
                                                <label for="city-column">Quantity</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input
                                                    type="text"class="form-control @error('price') is-invalid @enderror"
                                                    name="price" placeholder="Price">
                                                @error('price')
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('price') }}
                                                    </div>
                                                @enderror
                                                <label for="country-floating">Price</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="size">Size</label>
                                                <select class="select2 form-control @error('size') is-invalid @enderror"
                                                    name="size[]" multiple="multiple">
                                                    @foreach ($size as $item)
                                                        <option value="{{ $item->id }}">{{ $item->code }}</option>
                                                    @endforeach
                                                </select>
                                                @error('size')
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('size') }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="size">Color</label>
                                                <select class="select2 form-control @error('color') is-invalid @enderror"
                                                    name="color[]" multiple="multiple">
                                                    @foreach ($color as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('color')
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('color') }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="size">Marque</label>
                                                <input
                                                    type="text"class="form-control @error('marque') is-invalid @enderror"
                                                    name="marque" placeholder="Marque">
                                                @error('marque')
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('marque') }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="size">Photo Principal</label>
                                                <input type="file" name="file"
                                                    class="form-control @error('file') is-invalid @enderror"
                                                    accept=".jpg,.jpeg,.bmp,.png,.gif,.doc,.docx,.csv,.rtf,.xlsx,.xls,.txt,.pdf,.zip" />
                                                @error('file')
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('file') }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <input type="file" multiple name="files[]"
                                                label="Drop Images here or click to upload."
                                                help="Upload Images here and they won't be sent immediately" is="drop-files"
                                                accept=".jpg,.jpeg,.bmp,.png,.gif,.doc,.docx,.csv,.rtf,.xlsx,.xls,.txt,.pdf,.zip" />
                                        </div>
                                        <div class="col-12 d-flex justify-content-end mt-1">
                                            <a href="{{ route('admin.product.list') }}" class="btn btn-light-secondary mr-1">Return</a>
                                            <button type="submit" class="btn btn-primary ">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
    <script type="module" src="//unpkg.com/@grafikart/drop-files-element"></script>
    <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
@endsection
{{-- page scrips --}}
@section('page-scripts')
    <script src="{{ asset('js/scripts/forms/select/form-select2.js') }}"></script>
@endsection
