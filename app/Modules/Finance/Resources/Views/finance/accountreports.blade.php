@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || Account Incomes/Expenses 
@endsection



<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
    Account Incomes/Expenses
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
                                                <i class="fa fa-globe"></i>Account Incomes/Expenses
                                        </div>
                                </div>
                                
                                <div class="portlet-body dark_green">
                                    <div class="tabbable-custom ">
        <ul class="nav nav-tabs ">
            <li class="active">
                <a href="#tab_5_1" data-toggle="tab">
                    Incomes
                </a>
            </li>
            <li>
                <a href="#tab_5_2" data-toggle="tab">
                    Expenses
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
                        {{ Form::open(array('method' => 'POST', 'url' => 'finance/reports/accounts/incomes')) }}
                        <br>
                                <h4 class="form-section">Income<br></h4>
                        
                            <div class="col-md-6">
                                <label>Account:</label>
                                <select name="incomeaccount" data-placeholder="Select Account" class="form-control select2me" required="required" id="country_list" id="select2_sample4"   >
                                    <option></option>
                                    @foreach($incomeaccounts as $incomeaccount)
                                    <option value="{{ $incomeaccount->id }}">{{ $incomeaccount->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-12 form-actions fluid">
                                    <br><br>
                                    <div class="col-md-offset-4 col-md-9">
                                        <input type="submit" class="btn blue" value="Save">
                                        <input type="reset" name="clear" class="btn" id="clear" value="Clear">
                                    </div>
                                </div>
                        </form> 
                    </div>
                </div>
            </div>
                <div class="tab-pane" id="tab_5_2">
                    <div class="well dark_green">
                        <div class="row">
                        {{ Form::open(array('method' => 'POST', 'url' => 'finance/reports/accounts/expenses')) }}
                        <br>
                                <h4 class="form-section">Expense<br></h4>
                        
                            <div class="col-md-6">
                                <label>Account:</label>
                                <select name="expenseaccount" data-placeholder="Select Account" class="form-control select2me" required="required" id="country_list" id="select2_sample4"   >
                                    <option></option>
                                    @foreach($expenseaccounts as $expenseaccount)
                                    <option value="{{ $expenseaccount->id }}">{{ $expenseaccount->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 form-actions fluid">
                                    <br><br>
                                    <div class="col-md-offset-4 col-md-9">
                                        <input type="submit" class="btn blue" value="Save">
                                        <input type="reset" name="clear" class="btn" id="clear" value="Clear">
                                    </div>
                                </div>
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
                