<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h4>
            {{ isset($breadcrumb) ? \Jakubsacha\Adminlte\Helpers\Breadcrumbs::create($breadcrumb) : ''; }}
        </h4>
        
    </section>

    <!-- Main content -->
    <section class="content">
        @yield('content')
    </section><!-- /.content -->
</aside><!-- /.right-side -->