@props(["small"=>"", "text" => "Simpan"])
{{ html()->submit($text = icon('fas fa-save')." $text")->class('btn btn-success'.(($small=='true')? ' btn-sm' : '')) }}
