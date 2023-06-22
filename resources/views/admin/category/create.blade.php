<div class="modal fade" id="modal-category" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Create Category</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.category.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <fieldset class="form-group">
                                <label for="basicInput">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="basicInput" placeholder="Enter name ">
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
                                    @foreach ($category as $item)
                                        @if ($item->parent_id == null)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                    @endforeach
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
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
