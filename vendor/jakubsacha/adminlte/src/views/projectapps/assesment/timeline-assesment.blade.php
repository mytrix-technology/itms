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
                                        History - {{ $timelineAssesments->name_project }}
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                @foreach($timelineAssesments->historyassesment as $historyassesment)
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-tasks bg-maroon"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> {{ $historyassesment->created_at }}</span>
                                        <h3 class="timeline-header">
                                            <strong>{{ $historyassesment->user->username }}</strong> - {{ $historyassesment->title_history }}</h3>
                                        <div class="timeline-body">
                                            {{ $historyassesment->note_history}}
                                        </div>
                                        <div class='timeline-footer'>
                                            File : <a href="{{ URL::route('downloadAssesmentFiles', $timelineAssesments->id) }}">{{ $historyassesment->file_history}}</a>
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