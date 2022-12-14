<div class="text-center">
    <div class="btn-group btn-group-justified">
        <a href="{{ route('backend.users.edit', $data) }}" class="btn btn-success btn-sm me-1" data-toggle="tooltip"><i class="fa-solid fa-pencil"></i>
        </a>
        <form action="{{ route('backend.users.destroy', $data) }}" method="post">
            @csrf
            @method('DELETE')
            <a href="#" class="btn btn-success btn-sm me-1" title="Delete" data-toggle="tooltip"
                onclick="this.closest('form').submit();return false;">
                <i class="fas fa-trash-alt"></i>
            </a>
        </form>
        <a href="{{ route('backend.users.changePassword', $data) }}" class="btn btn-success btn-sm"
            data-toggle="tooltip" title="{{ __('labels.backend.changePassword') }}"><i class="fa-solid fa-lock"></i>
        </a>
    </div>
</div>
