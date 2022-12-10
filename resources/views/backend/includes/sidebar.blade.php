<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="d-md-flex sidebar-user justify-content-center align-items-center">
        <h4><i class="fas fa-user-circle me-2"></i> Admin</h4>
    </div>

    {!! $admin_sidebar->asUl(
        ['class' => 'sidebar-nav', 'data-coreui' => 'navigation', 'data-simplebar'],
        ['class' => 'nav-group-items'],
    ) !!}

    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>

<style type="text/css">
    .sidebar-user{
        height: 150px;
        background-image: url('{{ asset('img/bg_login.jpg') }}');
    }
</style>
