@extends(Config::get('syntara::views.master'))

@section('content')
<h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                
                <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        {{ $projectCount = DB::table('project')->count(); }}
                                    </h3>
                                    <p>
                                        Projects
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="{{ URL::route('listProjects') }}" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        {{ $tasklistCount = DB::table('tasklist')->count(); }}
                                    </h3>
                                    <p>
                                        Tasklist
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="{{ URL::route('listTasks') }}" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        {{ $dailyreportCount = DB::table('job_daily_report')->count(); }}<sup style="font-size: 20px"></sup>
                                    </h3>
                                    <p>
                                        Job Daily Report
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="{{ URL::route('listDailyReports') }}" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        {{ $updateappCount = DB::table('update_app')->count(); }}
                                    </h3>
                                    <p>
                                        Application Update
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="{{ URL::route('listUpdateAppss') }}" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                    <!-- Main row -->
                    <div class="row">
                        
                        <!-- Left col -->
                        <section class="col-lg-6 connectedSortable">
                            <div class="box box-warning">
                                <div class="box-header">
                                    <i class="fa fa-list"></i>
                                    <h3 class="box-title">Monitoring Document Project</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <!-- Progress bars -->
                                            <?php
                                                $projects = Project::join('master_status', 'master_status.id', '=', 'project.status_project_request')
                                                            ->where('master_status.group', '=', 'project')
                                                            ->orderby('project.status_project_request')
                                                            ->distinct()
                                                            ->get(array('project.status_project_request'));
                                            ?>  
                                            
                                            @foreach($projects as $project)
                                            <a href="{{ URL::route('dashProjects', $project->status_project_request) }}">
                                            <div class="clearfix">
                                                <span class="pull-left">{{ $project->masterstatus->status_name }}</span>
                                                <small class="pull-right">
                                                    @if ($project->status_project_request == 1)
                                                        {{ $statusproject = Project::where('status_project_request', '=', 1)
                                                                    ->count();
                                                        }}
                                                    @elseif ($project->status_project_request == 2) 
                                                        {{ $statusproject = Project::where('status_project_request', '=', 2)
                                                                    ->count();
                                                        }}
                                                    @elseif ($project->status_project_request == 3)
                                                        {{ $statusproject = Project::where('status_project_request', '=', 3)
                                                                    ->count();
                                                        }}
                                                    @elseif ($project->status_project_request == 23)
                                                        {{ $statusproject = Project::where('status_project_request', '=', 23)
                                                                    ->count();
                                                        }}
                                                    @elseif ($project->status_project_request == 24)
                                                        {{ $statusproject = Project::where('status_project_request', '=', 24)
                                                                    ->count();
                                                        }}
                                                    @elseif ($project->status_project_request == 25)
                                                        {{ $statusproject = Project::where('status_project_request', '=', 25)
                                                                    ->count();
                                                        }}
                                                    @elseif ($project->status_project_request == 26)
                                                        {{ $statusproject = Project::where('status_project_request', '=', 26)
                                                                    ->count();
                                                        }}
                                                    @elseif ($project->status_project_request == 27)
                                                        {{ $statusproject = Project::where('status_project_request', '=', 27)
                                                                    ->count();
                                                        }}
                                                    @else
                                                        {{ $statusproject = Project::where('status_project_request', '=', 4)
                                                                    ->count();
                                                        }}
                                                    @endif
                                                </small>
                                            </div>
                                            <div class="progress xs">
                                                @if ($project->status_project_request == 1)
                                                    <?php 
                                                        $countproject = Project::count('id');
                                                        $countstatus = Project::where('status_project_request', '=', 1)
                                                                            ->count();
                                                        $prosentase = ($countstatus/$countproject)*100;
                                                    ?>
                                                    <div class="progress-bar progress-bar-aqua" style="width:{{ $prosentase }}%"></div>
                                                @elseif ($project->status_project_request == 2)
                                                    <?php 
                                                        $countproject = Project::count('id');
                                                        $countstatus = Project::where('status_project_request', '=', 2)
                                                                            ->count();
                                                        $prosentase = ($countstatus/$countproject)*100;
                                                    ?>
                                                    <div class="progress-bar progress-bar-green" style="width:{{ $prosentase }}%"></div>
                                                @elseif ($project->status_project_request == 3)
                                                    <?php 
                                                        $countproject = Project::count('id');
                                                        $countstatus = Project::where('status_project_request', '=', 3)
                                                                            ->count();
                                                        $prosentase = ($countstatus/$countproject)*100;
                                                    ?>
                                                    <div class="progress-bar progress-bar-yellow" style="width:{{ $prosentase }}%"></div>
                                                @elseif ($project->status_project_request == 23)
                                                    <?php 
                                                        $countproject = Project::count('id');
                                                        $countstatus = Project::where('status_project_request', '=', 23)
                                                                            ->count();
                                                        $prosentase = ($countstatus/$countproject)*100;
                                                    ?>
                                                    <div class="progress-bar progress-bar-aqua" style="width:{{ $prosentase }}%"></div>
                                                @elseif ($project->status_project_request == 24)
                                                    <?php 
                                                        $countproject = Project::count('id');
                                                        $countstatus = Project::where('status_project_request', '=', 24)
                                                                            ->count();
                                                        $prosentase = ($countstatus/$countproject)*100;
                                                    ?>
                                                    <div class="progress-bar progress-bar-green" style="width:{{ $prosentase }}%"></div>
                                                @elseif ($project->status_project_request == 25)
                                                    <?php 
                                                        $countproject = Project::count('id');
                                                        $countstatus = Project::where('status_project_request', '=', 25)
                                                                            ->count();
                                                        $prosentase = ($countstatus/$countproject)*100;
                                                    ?>
                                                    <div class="progress-bar progress-bar-yellow" style="width:{{ $prosentase }}%"></div>
                                                @elseif ($project->status_project_request == 26)
                                                    <?php 
                                                        $countproject = Project::count('id');
                                                        $countstatus = Project::where('status_project_request', '=', 26)
                                                                            ->count();
                                                        $prosentase = ($countstatus/$countproject)*100;
                                                    ?>
                                                    <div class="progress-bar progress-bar-blue" style="width:{{ $prosentase }}%"></div>
                                                @elseif ($project->status_project_request == 27)
                                                    <?php 
                                                        $countproject = Project::count('id');
                                                        $countstatus = Project::where('status_project_request', '=', 27)
                                                                            ->count();
                                                        $prosentase = ($countstatus/$countproject)*100;
                                                    ?>
                                                    <div class="progress-bar progress-bar-green" style="width:{{ $prosentase }}%"></div>
                                                @elseif ($project->status_project_request == 4)
                                                    <?php 
                                                        $countproject = Project::count('id');
                                                        $countstatus = Project::where('status_project_request', '=', 4)
                                                                            ->count();
                                                        $prosentase = ($countstatus/$countproject)*100;
                                                    ?>
                                                    <div class="progress-bar progress-bar-red" style="width:{{ $prosentase }}%"></div>
                                                @endif
                                            </div>
                                            @endforeach
                                            </a>
                                        </div><!-- /.col -->
                                    </div><!-- /.row -->
                                </div>
                            </div><!-- /.box (chat box) -->
                            <!-- quick email widget -->
                        </section><!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-6 connectedSortable">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <i class="fa fa-list"></i>
                                    <h3 class="box-title">Monitoring Tasklist</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <!-- Progress bars -->
                                            <?php
                                                $tasks = TaskList::join('master_status', 'master_status.id', '=', 'tasklist.status_tasklist')
                                                        ->where('master_status.group', '=', 'tasklist')
                                                        ->orderby('tasklist.status_tasklist')
                                                        ->distinct()
                                                        ->get(array('tasklist.status_tasklist'));
                                            ?>
                                            @foreach($tasks as $task)
                                            <a href="{{ URL::route('dashTasks', $task->status_tasklist) }}">
                                            <div class="clearfix">
                                                <span class="pull-left"> {{ $task->masterstatus->status_name }}</span>
                                                <small class="pull-right">
                                                    @if ($task->status_tasklist == 5)
                                                        {{ $status = TaskList::where('status_tasklist', '=', 5)
                                                                    ->count();
                                                        }}
                                                    @elseif ($task->status_tasklist == 6)
                                                        {{ $status = TaskList::where('status_tasklist', '=', 6)
                                                                    ->count();
                                                        }}
                                                    @elseif ($task->status_tasklist == 7)
                                                        {{ $status = TaskList::where('status_tasklist', '=', 7)
                                                                    ->count();
                                                        }}
                                                    @elseif ($task->status_tasklist == 8) 
                                                        {{ $status = TaskList::where('status_tasklist', '=', 8)
                                                                    ->count();
                                                        }}
                                                    @elseif ($task->status_tasklist == 28) 
                                                        {{ $status = TaskList::where('status_tasklist', '=', 28)
                                                                    ->count();
                                                        }}
                                                    @elseif ($task->status_tasklist == 29) 
                                                        {{ $status = TaskList::where('status_tasklist', '=', 29)
                                                                    ->count();
                                                        }}
                                                    @elseif ($task->status_tasklist == 30) 
                                                        {{ $status = TaskList::where('status_tasklist', '=', 30)
                                                                    ->count();
                                                        }}
                                                    @elseif ($task->status_tasklist == 31) 
                                                        {{ $status = TaskList::where('status_tasklist', '=', 31)
                                                                    ->count();
                                                        }}
                                                    @elseif ($task->status_tasklist == 9) 
                                                        {{ $status = TaskList::where('status_tasklist', '=', 9)
                                                                    ->count();
                                                        }}
                                                    @else
                                                        {{ $status = TaskList::orderBy('id','DESC')
                                                                    ->count();
                                                        }}
                                                    @endif
                                                </small>
                                            </div>
                                            <div class="progress xs">
                                                @if ($task->status_tasklist == 5)
                                                    <?php 
                                                        $counttasklist = TaskList::count('id');
                                                        $countstatus = TaskList::where('status_tasklist', '=', 5)
                                                                            ->count();
                                                        $prosentase = ($countstatus/$counttasklist)*100;
                                                    ?>
                                                    <div class="progress-bar progress-bar-aqua" style="width:{{ $prosentase }}%"></div>
                                                @elseif ($task->status_tasklist == 6)
                                                    <?php 
                                                        $counttasklist = TaskList::count('id');
                                                        $countstatus = TaskList::where('status_tasklist', '=', 6)
                                                                            ->count();
                                                        $prosentase = ($countstatus/$counttasklist)*100;
                                                    ?>
                                                    <div class="progress-bar progress-bar-green" style="width:{{ $prosentase }}%"></div>
                                                @elseif ($task->status_tasklist == 7)
                                                    <?php 
                                                        $counttasklist = TaskList::count('id');
                                                        $countstatus = TaskList::where('status_tasklist', '=', 7)
                                                                            ->count();
                                                        $prosentase = ($countstatus/$counttasklist)*100;
                                                    ?>
                                                    <div class="progress-bar progress-bar-yellow" style="width:{{ $prosentase }}%"></div>
                                                @elseif ($task->status_tasklist == 8)
                                                    <?php 
                                                        $counttasklist = TaskList::count('id');
                                                        $countstatus = TaskList::where('status_tasklist', '=', 8)
                                                                            ->count();
                                                        $prosentase = ($countstatus/$counttasklist)*100;
                                                    ?>
                                                    <div class="progress-bar progress-bar-purple" style="width:{{ $prosentase }}%"></div>
                                                @elseif ($task->status_tasklist == 28)
                                                    <?php 
                                                        $counttasklist = TaskList::count('id');
                                                        $countstatus = TaskList::where('status_tasklist', '=', 28)
                                                                            ->count();
                                                        $prosentase = ($countstatus/$counttasklist)*100;
                                                    ?>
                                                    <div class="progress-bar progress-bar-blue" style="width:{{ $prosentase }}%"></div>
                                                @elseif ($task->status_tasklist == 29)
                                                    <?php 
                                                        $counttasklist = TaskList::count('id');
                                                        $countstatus = TaskList::where('status_tasklist', '=', 29)
                                                                            ->count();
                                                        $prosentase = ($countstatus/$counttasklist)*100;
                                                    ?>
                                                    <div class="progress-bar progress-bar-red" style="width:{{ $prosentase }}%"></div>
                                                @elseif ($task->status_tasklist == 30)
                                                    <?php 
                                                        $counttasklist = TaskList::count('id');
                                                        $countstatus = TaskList::where('status_tasklist', '=', 30)
                                                                            ->count();
                                                        $prosentase = ($countstatus/$counttasklist)*100;
                                                    ?>
                                                    <div class="progress-bar progress-bar-green" style="width:{{ $prosentase }}%"></div>
                                                @elseif ($task->status_tasklist == 31)
                                                    <?php 
                                                        $counttasklist = TaskList::count('id');
                                                        $countstatus = TaskList::where('status_tasklist', '=', 31)
                                                                            ->count();
                                                        $prosentase = ($countstatus/$counttasklist)*100;
                                                    ?>
                                                    <div class="progress-bar progress-bar-green" style="width:{{ $prosentase }}%"></div>
                                                @elseif ($task->status_tasklist == 9)
                                                    <?php 
                                                        $counttasklist = TaskList::count('id');
                                                        $countstatus = TaskList::where('status_tasklist', '=', 9)
                                                                            ->count();
                                                        $prosentase = ($countstatus/$counttasklist)*100;
                                                    ?>
                                                    <div class="progress-bar progress-bar-red" style="width:{{ $prosentase }}%"></div>
                                                @else
                                                    <?php 
                                                        $counttasklist = TaskList::count('id');
                                                        $countstatus = TaskList::orderBy('id','DESC')
                                                                            ->count();
                                                        $prosentase = ($countstatus/$counttasklist)*100;
                                                    ?>
                                                    <div class="progress-bar progress-bar-aqua" style="width:{{ $prosentase }}%"></div>
                                                @endif
                                            </div>
                                            @endforeach
                                            </a>
                                        </div><!-- /.col -->
                                    </div><!-- /.row -->
                                </div>
                            </div><!-- /.box (chat box) -->
                            
                        </section><!-- right col -->
                    </div><!-- /.row (main row) -->
                    
@stop
