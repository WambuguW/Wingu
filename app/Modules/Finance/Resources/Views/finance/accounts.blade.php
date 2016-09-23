@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || Accounts
@endsection



<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
    Accounts
@endsection
@section('page_content')
<script>
    function showalert(){
        if(confirm('Are you sure you want to delete bank?')){
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
                                                <i class="fa fa-globe"></i>Accounts
                                        </div>
                                </div>
                                
                                <div class="portlet-body dark_green">
                                    <div class="tabbable-custom ">
        <ul class="nav nav-tabs ">
            <li class="active">
                <a href="#tab_5_1" data-toggle="tab">
                    Accounts
                </a>
            </li>
            <li>
                <a href="#tab_5_2" data-toggle="tab">
                    Account Types
                </a>
            </li>
            <li>
                <a href="#tab_5_3" data-toggle="tab">
                    Functions
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
                        {{ Form::open(array('method' => 'POST')) }}
                        <div class="col-md-6">
                                <label>Account Name:</label>
                                <input type="text" name="accname" id="accname" placeholder="Account name" class="form-control input-medium" required="required">
                                <br> <br>
                            </div>
                        <div class="col-md-6">
                                <label>Account Code</label>
                                <input type="text" name="accode" id="accode" placeholder="Account Code" class="form-control input-medium" required="required">
                                <br> <br>
                            </div>
                        <div class="col-md-6">
                                <label>Account Status</label>
                                <select name="accstatus" id="accstatus" placeholder="Account Status" class="form-control input-medium" required="required">
                                    <option></option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                                <br> <br>
                            </div>
                        <div class="col-md-6">
                                <label>Type:</label>
                                <select name="acctype" id="acctype" placeholder="Account Type" class="form-control input-medium" required="required">
                                    <option></option>
                                    @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                <br> <br>
                            </div>
                        <div class="col-md-6" id="newaccount">

                            </div>
                            <div class="col-md-6">
                                <br><br>
                                <span class="btn blue" id="addaccount">Add Account</span>&nbsp; &nbsp;
                                <input type="reset" name="clear" class="btn" value="Clear">
                            </div>
                        </form> 
                        <div class="col-md-12">
                        <table id="accstable" class="table table-striped table-bordered table-hover table-full-width">
                            <tr>
                                <th>Account Name</th><th>Account Code</th><th>Status</th>
                            </tr>
                                @foreach($accounts as $account)
                                <tr><td>{{ $account->name }}</td><td>{{ $account->accode }}</td><td>{{ $account->status }}</td></tr>
                                @endforeach

                        </table>
                    </div>
                    </div>
                </div>
            </div>
                <div class="tab-pane" id="tab_5_2">
                    <div class="well dark_green">
                        <div class="row">
                        {{ Form::open(array('method' => 'POST', 'files' => true, 'url' => 'finance/accounts/voteheads')) }}
                            <div class="col-md-12 form-group">
                                <br>
                                <h4 class="form-section">New Account Type<br></h4>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <labe>Function:</labe>
                                        <select class="form-control input-medium" name="accfuncoptions" id="accfuncoptions" placeholder="Account Function">
                                            <option></option>
                                            @foreach($functions as $function)
                                            <option value="{{ $function->code }}">{{ $function->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Name:</label>
                                        <input type="text" name="acctypename" id="acctypename" class="form-control input-medium" placeholder="New Votehead" required="required">                                        
                                    </div>
                                    <div class="col-md-6">
                                        <labe>Description:</labe>
                                        <input type="text" class="form-control input-medium" name="acctypedescription" id="acctypedescription" placeholder="Type Description">                                           
                                    </div>
                                    
                                </div>
                                
                                <div class="col-md-12 form-actions fluid">
                                    <br><br>
                                    <div class="col-md-offset-4 col-md-9">
                                        <span class="btn blue" id="addnewacctype">Save</span> &nbsp; &nbsp;
                                        <input type="reset" name="clear" class="btn" id="clear" value="Clear">
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-12" id="">
                            <table id="acctypestable" class="table table-striped table-bordered table-hover table-full-width">
                            <tr>
                                <th>Type</th><th>Description</th><th>Function</th>
                            </tr>
                                @foreach($types as $type)
                                <tr><td>{{ $type->name }}</td><td>{{ $type->description }}</td><td></td></tr>
                                @endforeach

                        </table>
                        </div>
                        </div>
                        
                    </div>
                </div>
                <div class="tab-pane" id="tab_5_3">
                    <div class="well dark_green">
                        <div class="row">
                        {{ Form::open(array('method' => 'POST', 'files' => true, 'url' => 'finance/accounts/voteheads')) }}
                            <div class="col-md-12 form-group">
                                <br>
                                <h4 class="form-section">Add Function<br></h4>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <labe>Division:</labe>
                                        <select class="form-control input-medium" name="accfuncdivision" id="accfuncdivision" placeholder="Account Division">
                                            <option></option>
                                            @foreach($divisions as $division)
                                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Function:</label>
                                        <input type="text" name="newaccfunction" id="accfunctionname" class="form-control input-medium" placeholder="New Votehead" required="required">                                                                          
                                    </div>
                                    <div class="col-md-6">
                                        <labe>Description:</labe>
                                        <input type="text" name="accfuncdescription" id="accfuncdescription" class="form-control input-medium" placeholder="Function description" required="required">
                                    </div>
                                    <div class="col-md-12">
                                    
                                
                                <div class="col-md-12 form-actions fluid">
                                    <br><br>
                                    <div class="col-md-offset-4 col-md-9">
                                        <span class="btn blue" id="addnewaccfunction">Add Function</span> &nbsp; &nbsp;
                                    <input type="reset" name="clear" class="btn" id="clear" value="Clear">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                        <div class="col-md-12" id="">
                            <table id="accfunctionstable" class="table table-striped table-bordered table-hover table-full-width">
                            <tr>
                                <th>Function Name</th><th>Division</th>
                            </tr>
                                @foreach($functions as $function)
                                <tr><td>{{ $function->name }}</td><td>{{ App\Modules\Finance\Helpers\FinanceFunctions::get_function_division($function->division_id) }}</td></tr>
                                @endforeach

                        </table>
                        </div>
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
                