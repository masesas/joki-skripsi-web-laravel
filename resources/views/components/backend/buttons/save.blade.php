@props(["small"=>""])
{{ html()->submit($text = icon('fas fa-save')." Simpan")->class('btn btn-success'.(($small=='true')? ' btn-sm' : '')) }}
