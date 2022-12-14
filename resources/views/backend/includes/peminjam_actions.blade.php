<div class="text-center">
    <div class="btn-group btn-group-justified">
        {{-- <a href="{{ route('backend.alat_pecah.show', $data) }}" class="btn btn-success btn-sm me-1" data-toggle="tooltip"><i class="fa-solid fa-eye"></i>
        </a> --}}
        @if (Auth::user()->status == 'laboran')
            <form action="{{ route('backend.peminjam.destroy', $data) }}" method="post">
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
