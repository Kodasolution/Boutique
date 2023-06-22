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
    <style>
        .borderImgUnique {
            padding: 5px;
            margin: 0 2px;
            width: 178px;
            border: 2px solid #dbac14;
            border-radius: 8px;
        }

        .borderImg {
            width: 165px;
            height: 100px;
            object-fit: contain;
        }
    </style>
@endsection

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Product</h4>
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
                            <form class="form" action="{{ route('admin.product.update', ['product' => $product->id]) }}"
                                method="POST" enctype="multipart/form-data">
                                @method('patch')
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="text" id="first-name-column" name="name"
                                                    value="{{ $product->name }}"
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
                                                                <option value="{{ $cat->id }}"
                                                                    {{ $cat->id == $product->category_id ? 'selected' : '' }}>
                                                                    {{ $cat->name }}
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
                                                    value="{{ $product->quantity }}"
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
                                                    name="price" placeholder="Price" value="{{ $product->price }}">
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
                                                        <option value="{{ $item->id }}"
                                                            @foreach ($product->sizes as $siz) {{ $item->id === $siz->size_id ? 'selected' : '' }} @endforeach>
                                                            {{ $item->code }}</option>
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
                                                        <option value="{{ $item->id }}"
                                                            @foreach ($product->colors as $col) {{ $item->id === $col->color_id ? 'selected' : '' }} @endforeach>
                                                            {{ $item->name }}</option>
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
                                                    name="marque" placeholder="Marque" value="{{ $product->marque }}">
                                                @error('marque')
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('marque') }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            {{-- <div class="form-group">
                                                <label for="size">Photo Principal</label>
                                                <input type="file" name="file"
                                                    class="form-control @error('file') is-invalid @enderror"
                                                    accept=".jpg,.jpeg,.bmp,.png,.gif,.doc,.docx,.csv,.rtf,.xlsx,.xls,.txt,.pdf,.zip" />
                                                @error('file')
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('file') }}
                                                    </div>
                                                @enderror
                                            </div> --}}
                                            <input type="hidden" name="status" value="0" class="disables">
                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                <p class="mb-0">Status</p>
                                                <input type="checkbox"{{ $product->status === 1 ? 'checked' : '' }} name="status" value="1" class="custom-control-input" id="customSwitchcolor2">
                                                <label class="custom-control-label" for="customSwitchcolor2"></label>
                                              </div>
                                        </div>
                                        {{-- <div class="col-md-12 col-12">
                                            <input type="file" multiple name="files[]"
                                                label="Drop Images here or click to upload."
                                                help="Upload Images here and they won't be sent immediately"
                                                is="drop-files"
                                                accept=".jpg,.jpeg,.bmp,.png,.gif,.doc,.docx,.csv,.rtf,.xlsx,.xls,.txt,.pdf,.zip" />
                                        </div> --}}
                                        <div class="col-md-12 col-12 "
                                            style="overflow: auto;max-height: 235px;padding: 0 !important;display: flex;justify-content: start;align-items: center;">
                                            {{-- <div class="form-group"> --}}
                                            {{-- <label>Photos</label> --}}
                                            @foreach ($photo as $item)
                                                <div class="borderImgUnique">
                                                    <div
                                                        class="d-flex align-items-center justify-content-center mb-1 w-100">
                                                        <input type="radio"
                                                            @if ($item->principal == 1) @checked(true) @endif
                                                            name="principal" value="{{ $item->id }}">
                                                        <span class="font-weight-boldest">&nbsp;
                                                            @if ($item->principal == 1)
                                                                principale
                                                            @else
                                                                set principale
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <label for="file{{ $item->id }}">
                                                        <input type="file"accept="image/*" class=" form-control"
                                                            name="files[{{ $item->id }}]" class="file"
                                                            id="file{{ $item->id }}"
                                                            onchange="readURL(this, 'blah');" style="display: none;">
                                                        <img id="image{{ $item->id }}"
                                                            src="{{ asset('storage/file/' . $item->url) }}"
                                                            alt="image-xxxx-xxxx{{ $item->id }}" class="borderImg" />
                                                    </label>
                                                </div>
                                            @endforeach
                                            @error('images')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('images') }}
                                                </div>
                                            @enderror
                                            {{-- </div> --}}
                                        </div>
                                        <div class="col-12 d-flex justify-content-end mt-1">
                                            <button type="submit" class="btn btn-primary mr-1">Submit</button>
                                            <a href="{{ route('admin.product.list') }}"
                                                class="btn btn-light-secondary">Return</a>
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
