@extends(Config::get('adminlte::views.master'))

@section('content')
		<!-- row -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- The time line -->
                            <ul class="timeline">
                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-aqua">
                                        History - {{ $timelineTasks->subject }}
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                @foreach($timelineTasks->historytasklist as $historytasklist)
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-tasks bg-maroon"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> {{ $historytasklist->created_at }}</span>
                                        <h3 class="timeline-header"><strong>{{ $historytasklist->user1->username }}</strong> - {{ $historytasklist->title_history }}</h3>
                                        <div class="timeline-body">
                                            {{ $historytasklist->note_history }}
                                        </div>
                                        <div class='timeline-footer'>
                                        
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                                <!-- END timeline item -->
                                <li>
                                    <i class="fa fa-clock-o"></i>
                                </li>
                            </ul>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
@stop