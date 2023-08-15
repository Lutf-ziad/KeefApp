<div class="mb-1 d-inline-block"  data-toggle="tooltip" title="More Actions">
    <div class="dropdown d-inline-block">
        <button class="btn btn-sm btn-outline-dark dropdown-toggle" style="padding-right: 11px;" type="button" data-toggle="dropdown" aria-expanded="false">
        </button>
        <div class="dropdown-menu">
          @foreach ($actions as $action)
          <a class="dropdown-item" href="{{route($action['route'],$action['id'])}}">{{$action["label"]}}</a>
          @endforeach
        </div>
      </div>
</div>
