<div class="text-center">
    <a href="{{route('backend.users.edit', $data)}}" class="btn btn-success btn-sm mt-1" data-toggle="tooltip" title="{{__('labels.backend.edit')}}"><i class="fa-solid fa-pencil"></i></a>
    <a href="{{route('backend.users.show', $data)}}" class="btn btn-success btn-sm mt-1" data-toggle="tooltip" title="{{__('labels.backend.show')}}"><i class="fa-solid fa-trash"></i></a>
    <a href="{{route('backend.users.changePassword', $data)}}" class="btn btn-success btn-sm mt-1" data-toggle="tooltip" title="{{__('labels.backend.changePassword')}}"><i class="fa-solid fa-lock"></i></a>
</div>
