<div class="mb-1 d-inline-block" data-toggle="modal" title="Restore">
    <button class="btn btn-sm btn-outline-secondary" type="button" data-toggle="modal"
        data-target="#confirm-restore-modal-{{ $id->id }}">
        <i class="fas fa-trash-restore" style="padding-right: 1.8px;padding-left:1.8px;"></i>
    </button>
</div>
<div class="modal fade" id="confirm-restore-modal-{{ $id->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                <h4 class="card-title"> Are you sure want to restore field?</h4>
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <form action="{{ route($route, $id) }}" method="post">
                    @csrf

                    <button type="submit" class="btn btn-secondary">Restore</button>
                </form>
            </div>
        </div>
    </div>
</div>
