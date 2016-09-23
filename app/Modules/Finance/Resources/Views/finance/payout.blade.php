@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || Make Payments
@endsection


<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
    Make Payments
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
                                                <i class="fa fa-globe"></i>Make Payments
                                        </div>
                                </div>
                                
                                <div class="portlet-body dark_green">
                                    <div class="well dark_green">
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
                                        <div class="row">
                                            
                                            {{ Form::open(array('action' => 'FinanceController@payout', 'method' => 'POST')) }}
                                                
                                                <div class="col-md-6">
                                                    <label>Receiver Name:</label>
                                                    <input type="text" name="receivername" class="form-control" placeholder="" id="name">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Receiver ID/Phone:</label>
                                                    <input type="number" name="receiverid" class="form-control" placeholder="" id="">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Date:</label>
                                                    <input type="date" name="paydate" class="form-control" placeholder="" id="">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Reason:</label>
                                                    <input type="text" name="reason" class="form-control" placeholder="" id="">
                                                </div>

                                                <div class="col-md-6">
                                                    <label>Payment Mode:</label>
                                                    <select name="paymode" class="form-control" required="required">
                                                        <option value=""></option>
                                                        <option value="1">Bank Deposit</option>
                                                        <option value="2">Cheque</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Amount</label>
                                                    <input type="number" name="amount" class="form-control" placeholder="Amount" required="required">
                                                </div>                
                                                <div class="col-md-6">
                                                    <label>Bank Name:</label>
                                                    <select class="form-control" name="bank" required="required">
                                                        <option value=""></option>
                                                        <option value="1">KCB</option>
                                                        <option value="2">Equity</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label> Slip/Cheque No.:</label>
                                                    <input type="text" name="receiptno" class="form-control" placeholder="Cheque No." required="required">
                                                </div>

                                                <div class="col-md-6">
                                                    <label>Date of Payment:</label>
                                                    <input type="date" name="paydate" class="form-control form-control-inline date-picker" required="required">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Account:</label>
                                                    <select name="term" class="form-control" required="required">
                                                        <option value=""></option>
                                                        <option value="1">Account 1</option>
                                                        <option value="2">Account 1</option>
                                                        <option value="3">Account 1</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <br><br>
                                                    <input type="submit" name="complete" class="btn blue" value="Complete"> &nbsp; &nbsp;
                                                    <input type="reset" name="clear" class="btn" value="Clear">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </div>
            </div>

                    <!-- END PAGE CONTENT-->
<!--------------------------------------------------------END OF PAGE CONTENT-------------------------------------------->
@endsection
                