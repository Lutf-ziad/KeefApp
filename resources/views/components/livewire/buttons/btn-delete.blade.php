<div class="mb-1 d-inline-block" data-toggle="tooltip" title="Delete">
    <button class="btn btn-sm btn-outline-danger" type="button" data-toggle="modal"
        data-target="#confirm-delete-{{ $id }}">
        <i class="fa fa-trash-alt" style="padding-right: 1.8px;padding-left:1.8px;"></i>
    </button>
</div>
<div wire:ignore.self class="mb-1 d-inline-block" data-toggle="tooltip" title="Delete">
    <div class="modal fade" id="confirm-delete-{{ $id }}" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content card-outline">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4> Are you sure want to delete?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"
                        wire:click.prevent="delete({{ $id }})">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
