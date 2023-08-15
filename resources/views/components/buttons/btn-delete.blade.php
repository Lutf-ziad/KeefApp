<div class="mb-1 d-inline-block" data-toggle="modal" title="Delete">
    <button class="btn btn-sm btn-outline-danger" type="button" data-toggle="modal"
        data-target="#confirm-delete-modal-{{ $id->id }}">
        <i class="fa fa-trash-alt" style="padding-right: 1.8px;padding-left:1.8px;"></i>
    </button>
</div>
<div class="modal fade" id="confirm-delete-modal-{{ $id->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="card-title"> Are you sure want to delete?</h5>
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <form action="{{ route($route, $id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
