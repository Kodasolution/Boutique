<form class="form form-horizontal" action="{{ route('admin.color.store') }}" method="POST">
    @csrf
    <div class="form-body">
        <div class="row">
            <div class="col-md-4">
                <label>Name</label>
            </div>
            <div class="col-md-8 form-group">
                <input type="text" id="name" class="form-control" name="name" placeholder="Name">
            </div>
            <div class="col-sm-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mr-1">Submit</button>
                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
            </div>
        </div>
    </div>
</form>
