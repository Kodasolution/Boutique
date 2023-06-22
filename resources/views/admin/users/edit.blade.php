@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title', 'Users Edit')
{{-- vendor styles --}}
@section('vendor-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/pickers/pickadate/pickadate.css') }}">
@endsection

{{-- page styles --}}
@section('page-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/app-users.css') }}">
@endsection

@section('content')
    <!-- users edit start -->
    <section class="users-edit">
        <div class="card">
            <div class="card-body">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <ul class="nav nav-tabs mb-2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab"
                            href="#account" aria-controls="account" role="tab" aria-selected="true">
                            <i class="bx bx-user mr-25"></i><span class="d-none d-sm-block">Account</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab"
                            href="#information" aria-controls="information" role="tab" aria-selected="false">
                            <i class="bx bx-info-circle mr-25"></i><span class="d-none d-sm-block">Information</span>
                        </a>
                    </li> --}}
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">
                        <!-- users edit media object start -->
                        <div class="media mb-2">
                            <a class="mr-2" href="javascript:void(0);">
                                <img src="{{ asset('images/portrait/small/avatar-s-26.jpg') }}" alt="users avatar"
                                    class="users-avatar-shadow rounded-circle" height="64" width="64">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Avatar</h4>
                                <div class="col-12 px-0 d-flex">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-primary mr-25">Change</a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-light-secondary">Reset</a>
                                </div>
                            </div>
                        </div>
                        <!-- users edit media object ends -->
                        <!-- users edit account form start -->
                        <form action="{{ route('admin.user.update', ['user' => $user->id]) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>First Name</label>
                                            <input type="text"
                                                class="form-control @error('firstName') is-invalid @enderror"
                                                placeholder="First Name" value="{{ $user->firstName }}" name="firstName">
                                            @error('firstName')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('firstName') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>E-mail</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Email" value="{{ $user->email }}" name="email">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('email') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select class="form-control" name="role">
                                            <option value="0"{{ $user->role == '0' ? 'selected' : '' }}>User</option>
                                            <option value="1"{{ $user->role == '1' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Last Name</label>
                                            <input type="text"
                                                class="form-control @error('lastName') is-invalid @enderror"
                                                placeholder="Last Name" value="{{ $user->lastName }}" name="lastName">
                                            @error('lastName')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('lastName') }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror" placeholder="Phone"
                                            value="{{ $user->phone }}">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $errors->first('phone') }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="1"{{ $user->status == '1' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0"{{ $user->status == '0' ? 'selected' : '' }}>Banned
                                            </option>
                                            <option value="0"{{ $user->status == '0' ? 'selected' : '' }}>Close
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table mt-1">
                                            <thead>
                                                <tr>
                                                    <th>Module Permission</th>
                                                    <th>Read</th>
                                                    <th>Write</th>
                                                    <th>Create</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Users</td>
                                                    <td>
                                                        <div class="checkbox"><input type="checkbox" id="users-checkbox1"
                                                                class="checkbox-input" checked>
                                                            <label for="users-checkbox1"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox"><input type="checkbox" id="users-checkbox2"
                                                                class="checkbox-input"><label
                                                                for="users-checkbox2"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox"><input type="checkbox" id="users-checkbox3"
                                                                class="checkbox-input"><label
                                                                for="users-checkbox3"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox"><input type="checkbox" id="users-checkbox4"
                                                                class="checkbox-input" checked>
                                                            <label for="users-checkbox4"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Articles</td>
                                                    <td>
                                                        <div class="checkbox"><input type="checkbox" id="users-checkbox5"
                                                                class="checkbox-input"><label
                                                                for="users-checkbox5"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox"><input type="checkbox" id="users-checkbox6"
                                                                class="checkbox-input" checked>
                                                            <label for="users-checkbox6"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox"><input type="checkbox" id="users-checkbox7"
                                                                class="checkbox-input"><label
                                                                for="users-checkbox7"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox"><input type="checkbox" id="users-checkbox8"
                                                                class="checkbox-input" checked>
                                                            <label for="users-checkbox8"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Staff</td>
                                                    <td>
                                                        <div class="checkbox"><input type="checkbox" id="users-checkbox9"
                                                                class="checkbox-input" checked>
                                                            <label for="users-checkbox9"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox"><input type="checkbox"
                                                                id="users-checkbox10" class="checkbox-input" checked>
                                                            <label for="users-checkbox10"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox"><input type="checkbox"
                                                                id="users-checkbox11" class="checkbox-input"><label
                                                                for="users-checkbox11"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox"><input type="checkbox"
                                                                id="users-checkbox12" class="checkbox-input"><label
                                                                for="users-checkbox12"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> --}}
                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                    <a href="{{ route('admin.user.list') }}" class="btn btn-light mr-2">Return</a>
                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Save
                                        changes</button>
                                </div>
                            </div>
                        </form>
                        <!-- users edit account form ends -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- users edit ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
    <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('vendors/js/pickers/pickadate/picker.date.js') }}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
    <script src="{{ asset('js/scripts/pages/app-users.js') }}"></script>
    <script src="{{ asset('js/scripts/navs/navs.js') }}"></script>
@endsection
