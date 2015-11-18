@extends(Config::get('adminlte::views.master'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                
            </div>
            <div class="box-body  ajax-content no-padding">
                @include('adminlte::mailbox.list-mailbox')
            </div>
        </div>
    </div>
</div>


@stop