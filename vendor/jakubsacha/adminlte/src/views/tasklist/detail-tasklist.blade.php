@extends(Config::get('adminlte::views.master'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h1 class="box-title">Task Detail</h1>
                </div>
                <div class="box-body">
                    <table coll="3" border="0">
                        <tr>
                            <td>Reference Project</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>
                                @if($taskdetails->reference != null || $taskdetails->reference != 0)
                                    {{ $taskdetails->project->name_project }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Reference Design Version</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>
                                @if($taskdetails->reference_design != null)
                                    {{ $taskdetails->design->design_name_version }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Assigment From</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $taskdetails->user1->username }}</td>
                        </tr>
                        <tr>
                            <td>Assignment To</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $taskdetails->user2->username }}</td>
                        </tr>
                        <tr>
                            <td>Subject</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $taskdetails->subject }}</td>
                        </tr>
                        <tr>
                            <td>Task Description</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $taskdetails->desc_tasklist }}</td>
                        </tr>
                        <tr>
                            <td>Assignent Date</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $taskdetails->assignment_date }}</td>
                        </tr>
                        <tr>
                            <td>Due Date</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $taskdetails->due_date }}</td>
                        </tr>
                        <tr>
                            <td>Status Task</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $taskdetails->master_status->status_name }}</td>
                        </tr>
                        <tr>
                            <td>Master Task Type</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $taskdetails->mastertasktype->name_task_type }}</td>
                        </tr>
                        <tr>
                            <td>Change Plan in Database</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $taskdetails->database_change }}</td>
                        </tr>
                        <tr>
                            <td>Change Plan in Application File</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $taskdetails->apps_file_change }}</td>
                        </tr>
                        <tr>
                            <td>Parameter Reminder</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>&nbsp; {{ $taskdetails->parameter_reminder }} Days</td>
                        </tr>
                        <tr>
                            <td>Upload File</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>&nbsp; <a href="{{ URL::route('downloadTasks', $taskdetails->id) }}"> {{ $taskdetails->upload_file }}</a></td>
                        </tr>
                        <tr>
                            <td>Priority</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>&nbsp; {{ $taskdetails->masterstatus1->status_name }}</td>
                        </tr>
                        <tr>
                            <td>
                                <a class="btn btn-sm btn-success pull-left" href="{{ URL::route('listTasks') }}">Back</a>
                            </td>
                        </tr>

                    </table>

                </div>
            </div>
        </div>
    </div>
@stop