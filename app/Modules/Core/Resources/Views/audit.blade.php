@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || System Audit
@endsection
<script>
function filter(){
    inp = $('#inputdata').val()
    // This should ignore first row with th inside
    $("tr:not(:has(>th))").each(function() {
        if (~$(this).text().toLowerCase().indexOf( inp.toLowerCase() ) ) {
            // Show the row (in case it was previously hidden)
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}
</script>
<script>
    function delconfirm(mystring){
        if(confirm('Are you sure you want to delete adm. no.' + mystring + '?')){
            return true;
        }
        else{
            return false;
        }
        
    }
</script>
<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
    System Audit
@endsection
@section('page_content')
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->
                    <div class="row">
                        <!-- BEGIN PORTLET -->
                        <div class="col-md-10 col-sm-10 col-md-offset-1">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                        <div class="caption">
                                                <i class="fa fa-globe"></i>System Audit
                                        </div>
                                </div>
                                <div class="portlet-body">
                                    @if(isset($success))
                                        <div class="app-alerts alert alert-success fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                            {{ $success }}
                                        </div>
                                        @endif
                                    @if(isset($error))
                                    <div class="app-alerts alert alert-danger fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                        {{ $error }}
                                    </div>
                                    @endif
                                        
                                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_2">
                                        <thead>
                                        <tr>
                                                <th>
                                                    USER
                                                </th>
                                                <th>
                                                    ACTION
                                                </th>
                                                <th>
                                                    DATE/TIME
                                                </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($sys_audit as $audit)
                                            <tr><td>{{ AccountsController::get_user($audit->userid) }}</td><td>{{ $audit->action }}</td><td>{{ $audit->date }}</td></tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                            </div>

                            <!-- END PORTLET-->
                        </div>
                    </div>

                    <!-- END PAGE CONTENT-->
<!--------------------------------------------------------END OF PAGE CONTENT-------------------------------------------->
@endsection
                