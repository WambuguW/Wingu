@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || Student Details
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
    Student Details
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
                                                <i class="fa fa-globe"></i>All Students' Details
                                        </div>
                                        <div class="actions">
                                                <div class="btn-group">
                                                        <a class="btn default" href="#" data-toggle="dropdown">
                                                                 Columns to Display <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <div id="sample_2_column_toggler" class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
                                                                <label><input type="checkbox" checked data-column="0">Adm No</label>
                                                                <label><input type="checkbox" checked data-column="1">Name</label>
                                                                <label><input type="checkbox" checked data-column="2">Contact Person</label>
                                                                <label><input type="checkbox" checked data-column="3">Contact</label>                                                                
                                                                <label><input type="checkbox" checked data-column="4">Sex</label>
                                                                <label><input type="checkbox" checked data-column="5">Class Admitted</label>
                                                                <label><input type="checkbox" checked data-column="6">Current Class</label>
                                                                <label><input type="checkbox" checked data-column="7">Date Admitted</label>
                                                                <label><input type="checkbox" checked data-column="8">Action</label>
                                                        </div>
                                                </div>
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
                                                         Adm No.
                                                </th>
                                                <th>
                                                         Name
                                                </th>
                                                <th class="hidden-xs">
                                                         Contact Person
                                                </th>
                                                <th class="hidden-xs">
                                                         Contact
                                                </th>
                                                <th class="hidden-xs">
                                                         Sex
                                                </th>
                                                <th class="hidden-xs">
                                                         Class Admitted
                                                </th>
                                                <th class="hidden-xs">
                                                         Current Class
                                                </th>
                                                <th class="hidden-xs">
                                                         Date Admitted
                                                </th>
                                                <th class="hidden-xs">
                                                         Action
                                                </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($students as $student)
                                            <tr><td><a href="profile/{{ $student->admno }}">{{ $student->admno }}</a> </td><td><a href="profile/{{ $student->admno }}">{{  strtoupper($student->surname)  }}, {{  $student->fname }} {{ $student->lname  }} </a></td><td>{{ $student->surname  }} </td><td>{{ $student->contact  }} </td><td>{{ $student->sex  }} </td><td>{{ $student->classofadm  }} </td><td>{{ $student->currentclass  }} </td><td>{{ $student->admdate  }} </td><td><a href="edit/{{ $student->admno }}" class="btn btn-xs green">Edit <i class="fa fa-edit"></i></a> | <a href="delete/{{ $student->admno }}" onclick="return delconfirm({{ $student->admno }})" class="btn btn-xs red"> Delete <i class="fa fa-trash-o"></i></a> </td></tr>
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
                