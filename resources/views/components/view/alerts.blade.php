@if (session('message'))
<div class="alert alert-{{ session('message')['type'] ?? 'success' }}">
    {{ session('message')['text'] ?? 'msg' }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
