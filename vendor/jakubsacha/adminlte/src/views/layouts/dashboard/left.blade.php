<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left info">
                @if (Sentry::check())
                <p>{{ Sentry::getUser()->username }}</p>

                <a href="{{ URL::route('showUser', Sentry::getUser()->id ) }}"><i class="fa fa-circle text-success"></i> Online</a>
                @else
                    {{ "No Users Login" }}
                @endif
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            @if (Sentry::check())
            <li class="active">
                <a href="{{ URL::route('indexDashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            {{ (!empty($navPages)) ? $navPages : '' }}
                @if($currentUser->hasAccess('view-panel-project-list'))
                <li>
                    <a href="{{ URL::route('listPanelProjects') }}">
                        <i class="fa fa-desktop"></i> <span>Project</span>
                    </a>
                </li>
                @endif

                @if($currentUser->hasAccess('view-panel-design-list'))
                <li>
                    <a href="{{ URL::route('listPanelDesigns') }}">
                        <i class="fa fa-try"></i> <span>Design</span>
                    </a>
                </li>
                @endif

                @if($currentUser->hasAccess('view-panel-tasklist-list'))
                <li>
                    <a href="{{ URL::route('listPanelTasklists') }}">
                        <i class="fa fa-list-alt"></i> <span>Tasklist</span>
                    </a>
                </li>
                @endif

                @if($currentUser->hasAccess('view-panel-database-list'))
                <li>
                    <a href="{{ URL::route('listPanelDatabases') }}">
                        <i class="fa fa-cloud"></i> <span>Database</span>
                    </a>
                </li>
                @endif

                @if($currentUser->hasAccess('view-panel-report-list'))
                <li>
                    <a href="{{ URL::route('listPanelReports') }}">
                        <i class="fa fa-book"></i> <span>Report</span>
                    </a>
                </li>
                @endif

                @if($currentUser->hasAccess('view-panel-master-list'))
                <li>
                    <a href="{{ URL::route('listPanelMasters') }}">
                        <i class="fa fa-hdd-o"></i> <span>Master</span>
                    </a>
                </li>
                @endif

                @if($currentUser->hasAccess('view-panel-setting-list'))
                <li>
                    <a href="{{ URL::route('listPanelSettings') }}">
                        <i class="fa fa-cogs"></i> <span>Setting</span>
                    </a>
                </li>
                @endif
                {{ (!empty($navPagesRight)) ? $navPagesRight : '' }}
            @else
            <li>
                <a href="{{ URL::route('indexDashboard') }}">
                    <i class="fa fa-user"></i> <span>Login</span>
                </a>
            </li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
