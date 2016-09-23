@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
Wingu Client 1.0 || User Role Assignment
@endsection



<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
Fees Paid & Balances
@endsection
@section('page_content')
<script>
    function showalert() {
        if (confirm('Are you sure you want to delete bank?')) {
            return true;
        } else {
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
                    <i class="fa fa-globe"></i>User Role Assignment
                </div>
            </div>

            <div class="portlet-body dark_green">
                <div class="tabbable-custom ">
                    <ul class="nav nav-tabs ">
                        <li class="active">
                            <a href="#tab_5_1" data-toggle="tab">
                                Assign
                            </a>
                        </li>
                        <li>
                            <a href="#tab_5_2" data-toggle="tab">
                                De-assign
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_5_1">
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

                                    {{ Form::open(array('method' => 'POST', 'url' => 'core/accounts/roles/assign')) }}
                                                
                                               
                                            <div class="col-md-6">
                                                    <label>User:</label>
                                                    <select name="user" class="form-control input-medium" placeholder="Select User" required="required">
                                                        <option>--Select User--</option>
                                                        @foreach($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <br> <br>
                                                </div>
                                            
                                            <div class="col-md-6">
                                                    <label>Role:</label>
                                                    <select name="role" class="form-control input-medium" placeholder="Select Role" required="required">
                                                        <option>--Select Role--</option>
                                                        @foreach($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <br> <br>
                                                </div>
                                            <div class="col-md-6">
                                                    
                                                
                                            </div>
                                            
                                                <div class="col-md-6">
                                                    <br><br>
                                                    <input type="submit" class="btn blue" name="submit" value="Save">
                                                    <input type="reset" name="clear" class="btn" value="Clear">
                                                </div>
                                            
                                            <br><br>
                                            
                                            </form> 
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_5_2">
                            <div class="well dark_green">
                                <div class="row">

                                    {{ Form::open(array('method' => 'POST', 'url' => 'core/accounts/roles/deassign')) }}
                                                
                                               
                                            <div class="col-md-6">
                                                    <label>User:</label>
                                                    <select name="userid" class="form-control input-medium" placeholder="Select User" required="required">
                                                        <option>--Select User--</option>
                                                        @foreach($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <br> <br>
                                                </div>
                                            
                                            <div class="col-md-6">
                                                    <label>Role:</label>
                                                    <select name="roleid" class="form-control input-medium" placeholder="Select Role" required="required">
                                                        <option>--Select Role--</option>
                                                        @foreach($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <br> <br>
                                                </div>
                                            <div class="col-md-6">
                                                    
                                                
                                            </div>
                                            
                                                <div class="col-md-6">
                                                    <br><br>
                                                    <input type="submit" class="btn blue" name="submit" value="Save">
                                                    <input type="reset" name="clear" class="btn" value="Clear">
                                                </div>
                                            
                                            <br><br>
                                            
                                            </form> 
                                </div>

                            </div>
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
