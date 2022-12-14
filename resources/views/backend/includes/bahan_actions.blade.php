<div class="text-center">
    <div class="btn-group btn-group-justified">
        <a href="{{ route('backend.bahan.show', $data) }}" class="btn btn-success btn-sm me-1" data-toggle="tooltip"><i
                class="fa-solid fa-eye"></i>
        </a>
        @if (Auth::user()->status === 'laboran')
            <a href="{{ route('backend.bahan.edit', $data) }}" class="btn btn-success btn-sm me-1" data-toggle="tooltip"><i
                    class="fa-solid fa-pencil"></i>
            </a>
            <form action="{{ route('backend.bahan.destroy', $data) }}" method="post">
                @csrf
                @method('DELETE')
                <a href="#" class="btn btn-success btn-sm me-1" title="Delete" data-toggle="tooltip"
                    onclick="this.closest('form').submit();return false;">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </form>
        @endif
    </div>
</div>
