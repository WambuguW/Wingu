@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || System Users
@endsection



<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
    System Users
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
                                                <i class="fa fa-globe"></i>System Users
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
                                            
                                            {{ Form::open(array('method' => 'POST')) }}
                                                
                                                    
                                            <div class="col-md-6">
                                                    <label>Username:</label>
                                                    <input type="text" name="newuser" id="newuser" placeholder="Username" class="form-control input-medium" required="required">
                                                    <br> <br>
                                                </div>
                                            <div class="col-md-6">
                                                    <label>Email Address:</label>
                                                    <input type="email" name="email" id="email" placeholder="Email Address" class="form-control input-medium" required="required">
                                                    <br> <br>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>User Role:</label>
                                                    <select class="form-control input-medium" name="userrole" id="userrole" placeholder="Select the User role" required="required">
                                                        <option></option>
                                                        @foreach($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                        @endforeach                                                        
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>User Status:</label>
                                                    <select class="form-control input-medium" id="userstatus" name="userstatus" placeholder="Select the user status" required="required">
                                                        <option></option>
                                                        <option value="Active">Active</option>
                                                        <option value="Suspended">Suspended</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <br><br>
                                                    <span class="btn blue" id="addnewuser">Add User</span>&nbsp; &nbsp;
                                                    <input type="reset" name="clear" class="btn" value="Clear">
                                                </div>
                                            </form> 
                                            <br><br>
                                            <div class="col-md-12">
                                            <table id="userstable" class="table table-striped table-bordered table-hover table-full-width">
                                                <tr>
                                                    <th>User Id</th><th>User Name</th><th>Email Address</th><th>Status</th><th>Action</th>
                                                </tr>
                                                    @foreach($sys_users as $sys_user)
                                                    <tr><td>{{ $sys_user->id }}</td><td>{{ $sys_user->username }}</td><td>{{ $sys_user->email }}</td><td>{{ $sys_user->active }}</td><td>@if($sys_user->status == 'Active')<span class="btn btn-xs btn-warning" id="action">Suspend</span>@else<span class="btn btn-xs btn-success" id="action">Activate</span>@endif<a href="{{ url('core/accounts/users/delete') }}/{{ $sys_user->id }}"><span class="btn btn-xs btn-danger" onclick="return showalert()">Delete</span></a></td></tr>
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
                