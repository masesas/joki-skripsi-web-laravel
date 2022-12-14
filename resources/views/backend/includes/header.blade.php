<header class="header header-sticky mb-4 header-user">
    <div class="container-fluid">
        <h4 class="text-center mx-auto text-white">{{ $module_title }}</h4>
    </div>
</header>

<style type="text/css">
    .header-user {
        background-image: url('{{ Auth::user()->status == "laboran" ? asset('img/bg_login.jpg') : asset('img/bg_login_user.jpg') }}');
    }
</style>
