<div class="modal fade" id="modal_category_edit{{ $item->id }}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Edit Category</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.category.update', ['category' => $item->id]) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label for="basicInput">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="basicInput" placeholder="Enter name "
                                    value="{{ $item->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @enderror
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="basicInput">Parent Name</label>
                                <select name="parent_id" id="" class="form-control">
                                    <option value="">Parent Name</option>
                                    @foreach ($category as $cat)
                                        @if ($item->parent_id !== null && $cat->parent_id == null)
                                            <option
                                                value="{{ $cat->id }}"{{ $cat->id == $item->parent_id ? 'selected' : '' }}>
                                                {{ $cat->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="basicInput">Status</label>
                                <select name="status" id="" class="form-control">
                                    <option value="disponible" {{ $item->status == 'disponible' ? 'selected' : '' }}>
                                        Disponible</option>
                                    <option value="finished" {{ $item->status == 'finished' ? 'selected' : '' }}>Termine
                                    </option>
                                    <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>en
                                        attante
                                    </option>
                                </select>
                            </fieldset>
                            <fieldset class="form-group col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary mr-1">Submit</button>
                                <button type="button" class=" btn btn-light-secondary" data-dismiss="modal"
                                    aria-label="Close">
                                    Close
                                </button>
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <h4 class="text-bold-700 text-italic">Sub Category</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>NAME</th>
                                            <th>CREATED DATE</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($item->categories as $chirden)
                                            <tr>
                                                <td class="text-bold-500">{{ $chirden->name }} </td>
                                                <td>{{ $chirden->created_at }}</td>
                                                <td>
                                                    <span
                                                        class="badge @if ($chirden->status == 'disponible') badge-light-success
                                        @elseif ($chirden->status == 'finished')
                                        badge-light-danger
                                        @else
                                        badge-light-warning @endif badge-pill">{{ $chirden->status }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
