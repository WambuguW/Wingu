@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || Incomes Expenses
@endsection



<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
    Incomes Expenses
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
                                                <i class="fa fa-globe"></i>Incomes/Expenses
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
                        {{ Form::open(array('method' => 'POST', 'url' => 'finance/incomes')) }}
                        <br>
                                <h4 class="form-section">Income<br></h4>
                        <div class="col-md-6">
                                <label>Receipt No.:</label>
                                <input type="text" name="incomereceiptno" placeholder="Receipt No" class="form-control input-medium" required="required">
                                <br> <br>
                            </div>
                        <div class="col-md-6">
                                <label>Payee</label>
                                <input type="text" name="incomepayee" placeholder="Payee" class="form-control input-medium" required="required">
                                <br> <br>
                            </div>
                        <div class="col-md-6">
                                <label>Approved By</label>
                                <input type="text" name="incomeapprovedby" placeholder="Approved By" class="form-control input-medium" required="required">                                    
                            </div>
                        <div class="col-md-6">
                                <label>Description:</label>
                                <input type="text" name="incomedescription" placeholder="Description" class="form-control input-medium" required="required">                                    
                            </div>
                            <div class="col-md-6">
                                <label>Bank:</label>
                                <select name="incomebank" class="form-control input-medium" placeholder="Bank" required="required">
                                    <option></option>
                                    @foreach($banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Account:</label>
                                <select name="incomeaccount" data-placeholder="Select Account" class="form-control select2me" required="required" id="country_list" id="select2_sample4"   >
                                    <option></option>
                                    @foreach($incomeaccounts as $incomeaccount)
                                    <option value="{{ $incomeaccount->id }}">{{ $incomeaccount->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Amount:</label>
                                <input type="number" name="incomeamount" placeholder="Amount" min="0" class="form-control input-medium" required="required">                                    
                            </div>
                            <div class="col-md-6">
                                    <label>Date:</label>
                                    <input type="text" name="incomedate" placeholder="dd-mm-yyyy" class="form-control form-control-inline date-picker" data-date-format="dd-mm-yyyy" required="required" >
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
                        {{ Form::open(array('method' => 'POST', 'url' => 'finance/expenses')) }}
                        <br>
                                <h4 class="form-section">Expense<br></h4>
                        <div class="col-md-6">
                                <label>Receipt No.:</label>
                                <input type="text" name="expensereceiptno" placeholder="Receipt No" class="form-control input-medium" required="required">
                                <br> <br>
                            </div>
                        <div class="col-md-6">
                                <label>Paid To</label>
                                <input type="text" name="expensepaidto" placeholder="Payee" class="form-control input-medium" required="required">
                                <br> <br>
                            </div>
                        <div class="col-md-6">
                                <label>Approved By</label>
                                <input type="text" name="expenseapprovedby" placeholder="Approved By" class="form-control input-medium" required="required">                                    
                            </div>
                        <div class="col-md-6">
                                <label>Description:</label>
                                <input type="text" name="expensedescription" placeholder="Description" class="form-control input-medium" required="required">                                    
                            </div>
                            <div class="col-md-6">
                                <label>Bank:</label>
                                <select name="expensebank" class="form-control input-medium" placeholder="Bank" required="required">
                                    <option></option>
                                    @foreach($banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Account:</label>
                                <select name="expenseaccount" data-placeholder="Select Account" class="form-control select2me" required="required" id="country_list" id="select2_sample4"   >
                                    <option></option>
                                    @foreach($expenseaccounts as $expenseaccount)
                                    <option value="{{ $expenseaccount->id }}">{{ $expenseaccount->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Amount:</label>
                                <input type="number" name="expenseamount" placeholder="Amount" min="0" class="form-control input-medium" required="required">                                    
                            </div>
                            <div class="col-md-6">
                                    <label>Date:</label>
                                    <input type="text" name="expensedate" placeholder="dd-mm-yyyy" class="form-control form-control-inline date-picker" data-date-format="dd-mm-yyyy" required="required" >
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
                