@extends(Config::get('adminlte::views.master'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-header">
                <h1 class="box-title">Application Project Detail</h1>
            </div>
            <div class="box-body clearfix">
                <div class="row-fluid">
                <div class="col-lg-4">
                    <table>
                        <tr>
                            <td>Project Name</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $detailprojects->name_project }}</td>
                        </tr>
                        <tr>
                            <td>Reference Number</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $detailprojects->reference }}</td>
                        </tr>    
                        <tr>
                            <td>Project Description</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $detailprojects->desc_project }}</td>
                        </tr>
                        <tr>    
                            <td>Application Master</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $detailprojects->masterapps->name_apps }}</td>
                        </tr>
                        <tr>    
                            <td>Modul Master</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $detailprojects->mastermodul->name_modul }}</td>
                        </tr>
                        <tr>    
                            <td>Project Type Master</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $detailprojects->masterprojecttype->name_project_type }}</td>
                        </tr>
                        <tr>
                            <td>
                                <a class="btn btn-sm btn-success pull-left" href="{{ URL::route('listProjects') }}">Back</a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-4">
                    <table>
                        <tr>
                            <td>User Request</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $detailprojects->user_request }}</td>
                        </tr>
                        <tr>
                            <td>Project Request Date</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $detailprojects->project_request_date }}</td>
                        </tr>
                        <tr>
                            <td>Due Date</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $detailprojects->due_date }}</td>
                        </tr>
                        <tr>
                            <td>Documentation Project File</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td><a href="{{ URL::route('downloadManualBooks', $detailprojects->id) }}"> {{ $detailprojects->doc_project_file }} </a></td>
                        </tr>
                        <tr>    
                            <td>Update Application</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>
                                @if($detailprojects->update_apps_id == null)
                                    {{ "" }}
                                @else
                                    {{ $detailprojects->updateapps1->filename_update }}
                                @endif
                            </td>
                        </tr>
                        <tr>    
                            <td>Project Status</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $detailprojects->masterstatus->status_name }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-4">
                    <table>
                        <tr>    
                            <td>Assesment Date</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $detailprojects->assesment_date }}</td>
                        </tr>
                        <tr>    
                            <td>Assesment User</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>@if($detailprojects->assesment_user == null)
                                    {{ "" }}
                                @else
                                    {{ $detailprojects->user1->username }}
                                @endif</td>
                        </tr>
                        <tr>    
                            <td>Assesment Note</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $detailprojects->assesment_note }}</td>
                        </tr>
                        <tr>    
                            <td>Training Target</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $detailprojects->training_target }}</td>
                        </tr>
                        <tr>    
                            <td>Training Actual Date</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $detailprojects->training_actual_date }}</td>
                        </tr>
                        <tr>    
                            <td>Trainer</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>
                                @if($detailprojects->trainer == null)
                                    {{ "" }}
                                @else
                                    {{ $detailprojects->user->username }}
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop