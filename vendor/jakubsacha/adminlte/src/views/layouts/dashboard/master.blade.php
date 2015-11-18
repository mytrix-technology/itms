<html>
    <head>
        <meta charset="UTF-8">
        <title>{{ (!empty($siteName)) ? $siteName : "ITMS"}} - {{isset($title) ? $title : 'ITMS' }}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        {{ HTML::style('packages/jakubsacha/adminlte/AdminLTE/css/bootstrap.min.css'); }}
        <!-- font Awesome -->
        {{ HTML::style('packages/jakubsacha/adminlte/AdminLTE/css/font-awesome.min.css'); }}
        <!-- Ionicons -->
        {{ HTML::style('packages/jakubsacha/adminlte/AdminLTE/css/ionicons.min.css'); }}
        <!-- Datepicker -->
        {{ HTML::style('packages/jakubsacha/adminlte/AdminLTE/css/datepicker/datepicker.css'); }}
        <!-- Datetimepicker -->
        {{ HTML::style('packages/jakubsacha/adminlte/AdminLTE/css/datetimepicker/jquery.datetimepicker.css'); }}
        <!-- Daterange picker -->
        {{ HTML::style('packages/jakubsacha/adminlte/AdminLTE/css/daterangepicker/daterangepicker-bs3.css'); }}
        <!-- DATA TABLES -->
        {{ HTML::style('packages/jakubsacha/adminlte/AdminLTE/css/datatables/dataTables.bootstrap.css'); }}
        {{ HTML::style('packages/jakubsacha/adminlte/AdminLTE/css/datatables/jquery.dataTables.css'); }}
        {{ HTML::style('packages/jakubsacha/adminlte/AdminLTE/css/datatables/dataTables.responsive.css'); }}
        <!-- bootstrap wysihtml5 - text editor -->
        {{ HTML::style('packages/jakubsacha/adminlte/AdminLTE/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); }}
        <!-- bootstrap dialog -->
        {{ HTML::style('packages/jakubsacha/adminlte/AdminLTE/css/bootstrap-dialog/bootstrap-dialog.min.css'); }}
        <!-- jquery ui -->
        {{ HTML::style('packages/jakubsacha/adminlte/AdminLTE/css/jQueryUI/jquery-ui-1.10.3.custom.css'); }}
        
        <!-- Theme style -->
        {{ HTML::style('packages/jakubsacha/adminlte/AdminLTE/css/AdminLTE.css'); }}
        
        <!-- jakubsacha css fix -->
        {{ HTML::style('packages/jakubsacha/adminlte/css/AdminLTE.css'); }}
        
        <style type="text/css" class="init">
            td.details-control {
                background: url(asset("packages/jakubsacha/adminlte/AdminLTE/img/details_open.png")) no-repeat center center;
                cursor: pointer;
            }
            tr.shown td.details-control {
                background: url(asset("packages/jakubsacha/adminlte/AdminLTE/img/details_close.png")) no-repeat center center;
            }
        </style>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        @if (!empty($favicon))
        <link rel="icon" {{ !empty($faviconType) ? 'type="$faviconType"' : '' }} href="{{ $favicon }}" />
        @endif

        <!-- jQuery 2.0.2 -->
        {{ HTML::script('packages/mrjuliuss/syntara/assets/js/dashboard/jquery210.min.js'); }}
        {{ HTML::script('packages/mrjuliuss/syntara/assets/js/dashboard/base.js'); }}
        
    </head>
    <body class="skin-blue fixed">
        @include(Config::get('adminlte::views.header'))

        <div class="wrapper row-offcanvas row-offcanvas-left">
            @include(Config::get('adminlte::views.left'))

            @include(Config::get('adminlte::views.content'))

        </div>
        <!-- jQuery UI 1.10.3 -->
        {{ HTML::script('packages/jakubsacha/adminlte/AdminLTE/js/jquery-ui.min.js'); }}
        <!-- Bootstrap -->
        {{ HTML::script('packages/jakubsacha/adminlte/AdminLTE/js/bootstrap.min.js'); }}
        <!-- Morris.js charts -->
        {{ HTML::script('packages/mrjuliuss/syntara/assets/js/dashboard/raphael-min.js'); }}
        <!-- datepicker -->
        {{ HTML::script('packages/jakubsacha/adminlte/AdminLTE/js/plugins/datepicker/bootstrap-datepicker.js'); }}
        <!-- datetimepicker -->
        {{ HTML::script('packages/jakubsacha/adminlte/AdminLTE/js/plugins/datetimepicker/jquery.datetimepicker.js');}}
        <!-- jQuery Knob Chart -->
        {{ HTML::script('packages/jakubsacha/adminlte/AdminLTE/js/plugins/jqueryKnob/jquery.knob.js'); }}
        <!-- daterangepicker -->
        {{ HTML::script('packages/jakubsacha/adminlte/AdminLTE/js/plugins/daterangepicker/daterangepicker.js'); }}
        <!-- Bootstrap WYSIHTML5 -->
        {{ HTML::script('packages/jakubsacha/adminlte/AdminLTE/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); }}
        <!-- Bootstrap Dialog -->
        {{ HTML::script('packages/jakubsacha/adminlte/AdminLTE/js/plugins/bootstrap-dialog/bootstrap-dialog.min.js'); }}
        <!-- iCheck -->
        {{ HTML::script('packages/jakubsacha/adminlte/AdminLTE/js/plugins/iCheck/icheck.min.js'); }}
        <!-- DATA TABlES SCRIPT -->
        {{ HTML::script('packages/jakubsacha/adminlte/AdminLTE/js/plugins/datatables/jquery.dataTables.min.js'); }}
        {{ HTML::script('packages/jakubsacha/adminlte/AdminLTE/js/plugins/datatables/dataTables.responsive.min.js'); }}
        <!-- moment -->
        {{ HTML::script('packages/jakubsacha/adminlte/js/moment.min.js'); }}
        
        <!-- AdminLTE App -->
        {{ HTML::script('packages/jakubsacha/adminlte/AdminLTE/js/AdminLTE/app.js'); }}
        {{ HTML::script('packages/jakubsacha/adminlte/js/app.js'); }}

        
        
        <script type="text/javascript">
            //Data table
            $(document).ready(function() {
                $('#example').dataTable({
                    "responsive": true,
                    "fnDrawCallback": function ( oSettings ) {
                        /* Need to redo the counters if filtered or sorted */
                        if ( oSettings.aoData!=null && oSettings.bSorted || oSettings.bFiltered )
                        {
                            for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
                            {
                                $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
                            }
                        }
                    },
                    "columnDefs": [{
                        //"className": 'control'
                        "visible": false,
                        "searchable": true,
                        "orderable": true,
                        "bPaginate": true,
                        "bSort": true,
                        "bInfo": true,
                        "targets": 2
                    }]
                    //"order": [[ 1, 'asc' ]]
				});
            });

            $(document).ready(function() {
                $('#jobdailyreport').dataTable({
                    "responsive": {
                        "breakpoints": [
                            { "name": 'desktop', "width": Infinity },
                            { "name": 'tablet',  "width": 1024 },
                            { "name": 'fablet',  "width": 768 },
                            { "name": 'phone',   "width": 480 }
                        ]
                    },
                    "fnDrawCallback": function ( oSettings ) {
                        /* Need to redo the counters if filtered or sorted */
                        if ( oSettings.aoData != null && oSettings.bSorted || oSettings.bFiltered )
                        {
                            for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
                            {
                                $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
                            }
                        }
                    },
                    
                    "columnDefs": [{
                        //"className": 'control'
                        "visible": false,
                        "searchable": true,
                        "orderable": true,
                        "bPaginate": true,
                        "bSort": true,
                        "bInfo": true,
                        "targets": 1
                    }],
                    "order": [[ 1, 'asc' ]]
                });
            });

            $(function() {
                // instance, using default configuration.
                //CKEDITOR.replace('mytextarea');

                $("#mytextarea").wysihtml5();
                $("#desc_project").wysihtml5();
                $("#assesment_note").wysihtml5();
                $("#training_target").wysihtml5();
                $("#uat_target").wysihtml5();
                $("#uat_note").wysihtml5();
                $("#desc_table_file").wysihtml5();
                $("#rule").wysihtml5();
                $("#remark").wysihtml5();
                $("#requirement_testing").wysihtml5();
                $("#database_change").wysihtml5();
                $("#apps_change").wysihtml5();
                $("#filename_update").wysihtml5();
                $("#weekly_meeting_note").wysihtml5();
                $("#desc_apps").wysihtml5();
                $("#note").wysihtml5();
                $("#desc_modul").wysihtml5();
            });

            // Open textbox
            $("#master_type_project_id").change(function(){
               if($(this).val()=="1" || $(this).val()=="2")
               {    
                   $("#reference").show();
               }
                else
                {
                    $("#reference").hide();
                }
            });

            $("#master_task_type_id").change(function(){
               if($(this).val()=="1")
               {    
                   $("#database_change").show();
                   $("#database_change").wysihtml5();
                   $("#apps_file_change").show();
                   $("#apps_file_change").wysihtml5();
               }
                else
                {
                    $("#database_change").hide();
                    $("#apps_file_change").hide();
                }
            });

            $("#comment").change(function () {
                //check if its checked. If checked move inside and check for others value
                if (this.checked && this.value === "comment") {
                    //show a text box
                    $("#title_history").show();
                    $("#note_history").show();
                    $("#note_history").wysihtml5();
                } else {
                    //hide the text box
                    $("#title_history").hide();
                    $("#note_history").show();
                }
            });

            $(function() {
                var icons = {
                    header: "ui-icon-circle-arrow-e",
                    activeHeader: "ui-icon-circle-arrow-s"
                    };
                    $( "#accordion" ).accordion({
                    icons: icons
                    });
                    $( "#toggle" ).button().click(function() {
                    if ( $( "#accordion" ).accordion( "option", "icons" ) ) {
                    $( "#accordion" ).accordion( "option", "icons", null );
                    } else {
                    $( "#accordion" ).accordion( "option", "icons", icons );
                    }
                });
            });
            
                jQuery('#datetimepicker').datetimepicker({
                	format: 'Y-m-d H:i:s'
                });

                jQuery('#datetimepicker1').datetimepicker({
                	format: 'Y-m-d H:i:s'
                });

                jQuery('#datetimepicker2').datetimepicker({
                	format: 'Y-m-d H:i:s'
                });

                jQuery('#datetimepicker3').datetimepicker({
                	format: 'Y-m-d H:i:s'
                });

                jQuery('#datetimepicker4').datetimepicker({
                	format: 'Y-m-d H:i:s'
                });

                $("#form_datetime").datetimepicker({
                    format: 'yyyy-mm-dd hh:ii:ss'
                });
            
                $('#datepicker').datepicker({
                    format: 'yyyy-mm-dd'
                });
                
                $('#datepicker1').datepicker({
                    format: 'yyyy-mm-dd'
                });
                
                $('#datepicker2').datepicker({
                    format: 'yyyy-mm-dd'
                });

                $('#datepicker3').datepicker({
                    format: 'yyyy-mm'
                });

                $('#dp3').datepicker({
                        format: "yyyy-mm",
                        viewMode: "months", 
                        minViewMode: "months"
                });
			
			/*
             * Custom Label formatter
             * ----------------------
             */
            function labelFormatter(label, series) {
                return "<div style='font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;'>"
                        + label
                        + "<br/>"
                        + Math.round(series.percent) + "%</div>";
            }
        </script>
    </body>
</html>