<header class="header">
    <a href="{{ URL::route('indexDashboard') }}" class="logo">
        {{ (!empty($siteName)) ? $siteName : "IT Management System"}}
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                @if(Sentry::check())
                    <?php
                        $users = Sentry::getUser();
		                $adm = Sentry::findGroupByName('Admin');
		                $head = Sentry::findGroupByName('HeadITDev');
		                $spv = Sentry::findGroupByName('SupervisorITDev');
		                $coord = Sentry::findGroupByName('CoordinatorITDev');

                        $taskOpen = DB::table('tasklist')
                                    ->where('status_tasklist','=', '5')
                                    ->where(function($query)
                                    {
                                        $query->where('assignment_from','=', Sentry::getUser()->id)
                                              ->orWhere('assignment_to','=', Sentry::getUser()->id);
                                    })
                                    ->count();
                        
                        $taskAll = DB::table('tasklist')
                                    ->where('status_tasklist','!=', '5')
                                    ->where(function($query)
                                    {
                                        $query->where('assignment_from','=', Sentry::getUser()->id)
                                              ->orWhere('assignment_to','=', Sentry::getUser()->id);
                                    })
                                    ->count();

                        $projectOpen = DB::table('project')
                                        ->where('status_project_request','=', '1')
                                        ->count();

                        $projectAll = DB::table('project')
                                        ->where('status_project_request','!=', '1')
                                        ->count();

                        $designAll = DB::table('design_apps')
                                        ->count();

                        $sitAll = DB::table('design_apps')
                                        ->where('status_sit','!=', 'null')
                                        ->count();

                        $uatAll = DB::table('uat')
                                        ->count();

                        $updateAppOpen = DB::table('update_app')
                                        ->where('status_update_apps','=', '16')
                                        ->count();

                        $updateAppAll = DB::table('update_app')
                                        ->where('status_update_apps','!=', '16')
                                        ->count();

                        $tasks = TaskList::orderBy('due_date', 'DESC')->get();
                    ?>
                    
                    <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning">{{ $taskCount = $taskOpen+$taskAll+$projectOpen+$projectAll+$designAll+$sitAll+$uatAll+$updateAppOpen+$updateAppAll }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have {{ $taskCount = $taskOpen+$taskAll+$projectOpen+$projectAll+$designAll+$sitAll+$uatAll+$updateAppOpen+$updateAppAll }} notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        @if($taskOpen > 0)
                                            <li>
                                                <a href="{{ URL::route('listTasks') }}">
                                                    <i class="fa fa-tasks info"></i> {{ $taskOpen }} new tasks created
                                                </a>
                                            </li>
                                        @endif

                                        @if($taskAll > 0)
                                            <li>
                                                <a href="{{ URL::route('listTasks') }}">
                                                    <i class="fa fa-tasks success"></i> {{ $taskAll }} tasks updated
                                                </a>
                                            </li>
                                        @endif

                                        @if($projectOpen > 0)
                                            <li>
                                                <a href="{{ URL::route('listProjects') }}">
                                                    <i class="fa fa-briefcase warning"></i> {{ $projectOpen }} new projects created
                                                </a>
                                            </li>
                                        @endif

                                        @if($projectAll > 0)
                                            <li>
                                                <a href="{{ URL::route('listProjects') }}">
                                                    <i class="fa fa-briefcase danger"></i> {{ $projectAll }} projects updated
                                                </a>
                                            </li>
                                        @endif

                                        @if($designAll > 0)
                                            <li>
                                                <a href="{{ URL::route('listDesigns') }}">
                                                    <i class="fa fa-columns info"></i> {{ $designAll }} designs updated
                                                </a>
                                            </li>
                                        @endif

                                        @if($sitAll > 0)
                                            <li>
                                                <a href="{{ URL::route('listTrainings') }}">
                                                    <i class="fa fa-list-alt success"></i> {{ $sitAll }} testing updated
                                                </a>
                                            </li>
                                        @endif

                                        @if($uatAll > 0)
                                            <li>
                                                <a href="{{ URL::route('listUats') }}">
                                                    <i class="fa fa-users warning"></i> {{ $uatAll }} user accept test updated
                                                </a>
                                            </li>
                                        @endif

                                        @if($updateAppOpen > 0)
                                            <li>
                                                <a href="{{ URL::route('listUpdateAppss') }}">
                                                    <i class="fa fa-gavel info"></i> {{ $updateAppOpen }} new update application created
                                                </a>
                                            </li>
                                        @endif

                                        @if($updateAppAll > 0)
                                            <li>
                                                <a href="{{ URL::route('listUpdateAppss') }}">
                                                    <i class="fa fa-gavel success"></i> {{ $updateAppAll }} update application updated
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-tasks"></i>
                        <span class="label label-danger">
                            {{ $taskOpen }}
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have {{ $taskAll }} tasks not close</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                @foreach($tasks as $task)
                                @if ($task->assignment_from == Sentry::getUser()->id || $task->assignment_to == Sentry::getUser()->id)
                                @if ($task->status_tasklist != 9)
                                <li><!-- Task item -->
                                    <a href="{{ URL::route('listTasks') }}">
                                        <h3>
                                            {{ $task->subject.' - '.$task->masterstatus->status_name }}
                                            <small class="pull-right">
                                                @if ($task->status_tasklist == 5) 10%
                                                @elseif ($task->status_tasklist == 6) 30%
                                                @elseif ($task->status_tasklist == 7) 50%
                                                @elseif ($task->status_tasklist == 8) 60%
                                                @elseif ($task->status_tasklist == 29) 70%
                                                @elseif ($task->status_tasklist == 30) 80%
                                                @elseif ($task->status_tasklist == 31) Hold
                                                @elseif ($task->status_tasklist == 28) 90%
                                                @else Hold
                                                @endif
                                            </small>
                                        </h3>
                                        <div class="progress xs">
                                            @if ($task->status_tasklist == 5)
                                                <div class="progress-bar progress-bar-aqua" style="width:10%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            @elseif ($task->status_tasklist == 6)
                                                <div class="progress-bar progress-bar-green" style="width:30%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            @elseif ($task->status_tasklist == 7)
                                                <div class="progress-bar progress-bar-yellow" style="width:50%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            @elseif ($task->status_tasklist == 8)
                                                <div class="progress-bar progress-bar-blue" style="width:60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            @elseif ($task->status_tasklist == 29)
                                                <div class="progress-bar progress-bar-red" style="width:70%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            @elseif ($task->status_tasklist == 30)
                                                <div class="progress-bar progress-bar-blue" style="width:80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            @elseif ($task->status_tasklist == 31)
                                                <div class="progress-bar progress-bar-yellow" style="width:0%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            @elseif ($task->status_tasklist == 28)
                                                <div class="progress-bar progress-bar-red" style="width:90%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            @else
                                                <div class="progress-bar progress-bar-aqua" style="width:0%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            @endif
                                        </div>
                                    </a>
                                </li><!-- end task item -->
                                @endif
                                @endif
                                @endforeach
                                
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="{{ URL::route('listTasks') }}">View all tasks</a>
                        </li>
                    </ul>
                </li>
                
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <span>{{ Sentry::getUser()->username }} <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            <p>
                                {{ Sentry::getUser()->username }}
                                <small>Member since {{ Sentry::getUser()->created_at }}</small>
                            </p>
                        </li>
                        
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ URL::route('showUser', Sentry::getUser()->id ) }}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ URL::route('logout') }}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </nav>
</header>