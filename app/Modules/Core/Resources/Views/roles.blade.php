@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || System Roles
@endsection



<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
    System Roles
@endsection
@section('page_content')
<script>
    function showalert(){
        if(confirm('Are you sure you want to delete user?')){
            return true;
        } else{
            return false;
        }
    }

</script>
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->
                    <div class="row">
                        <!-- BEGIN PORTLET -->
                        <div class="col-md-10 col-sm-10 col-md-offset-1">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                        <div class="caption">
                                                <i class="fa fa-globe"></i>System Roles
                                        </div>
                                </div>
                                
                                <div class="portlet-body dark_green">
                                    <div class="well dark_green">
                                        
                                        @if(isset($success))
                                            <div class="app-alerts alert alert-info fade in">
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
                                        <div class="row">
                                            
                                            {{ Form::open(array('method' => 'POST', 'url' => 'core/accounts/roles')) }}
                                                
                                                    
                                            <div class="col-md-6">
                                                    <label>Role Name:</label>
                                                    <input type="text" name="rolename" placeholder="Role Name" class="form-control input-medium" required="required">
                                                    <br> <br>
                                                </div>
                                            <div class="col-md-6">
                                                    <label>Role Display Name(Optional):</label>
                                                    <input type="text" name="roledisplayname" placeholder="Role Display Name" class="form-control input-medium">
                                                    <br> <br>
                                                </div>
                                            <div class="col-md-6">
                                                    <label>Role Description:</label>
                                                    <input type="text" name="roledescription" placeholder="Role Description" class="form-control input-medium" required="required">
                                                    <br> <br>
                                                </div>
                                                <div class="col-md-6">
                                                    <br><br>
                                                    <input type="submit" class="btn blue" name="submit" value="Save">
                                                    <input type="reset" name="clear" class="btn" value="Clear">
                                                </div>
                                            </form> 
                                            <br><br>
                                            <div class="col-md-12">
                                            <table class="table table-striped table-bordered table-hover table-full-width">
                                                <tr>
                                                    <th>No.</th><th>Role Name</th><th>Role Description</th>
                                                </tr>
                                                @foreach($roles as $role)
                                                <tr><td>{{ $role->id }}</td><td>{{ $role->name }}</td><td>{{ $role->description }}</td></tr>
                                                @endforeach
                                                    
                                                
                                            </table>
                                        </div>
                                        </div>
                                        
                                    </div>
                                </div>
                        </div>
                        </div>
            </div>

                    <!-- END PAGE CONTENT-->
<!--------------------------------------------------------END OF PAGE CONTENT-------------------------------------------->
@endsection
                