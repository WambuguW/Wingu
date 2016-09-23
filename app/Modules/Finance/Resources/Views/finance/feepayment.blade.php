@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || Fee Payment
@endsection



<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
    Fee Payment
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
                                                <i class="fa fa-globe"></i>Fee Payment
                                        </div>
                                </div>
                                
                                <div class="portlet-body dark_green">
                                    <div class="tabbable-custom ">
        <ul class="nav nav-tabs ">
            <li class="active">
                <a href="#tab_5_1" data-toggle="tab">
                    Make Payment
                </a>
            </li>
            <li>
                <a href="#tab_5_2" data-toggle="tab">
                    Invoice Students
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_5_1">
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


                            {{ Form::open(array('url' => 'finance/feepayment', 'method' => 'POST')) }}
                                <div class="col-md-4">
                                    <label>Student Adm No:</label>
                                    <select name="admno" data-placeholder="Select Student" class="form-control select2me" required="required" id="country_list" id="select2_sample4"   >
                                        <option></option>
                                     @if(isset($stude))
                                        @foreach($stude as $stud)
                                        <option value="{{ $stud->admno }}">{{ strtoupper($stud->surname) . ', ' . $stud->fname . ' ' . $stud->lname }} </option>
                                        @endforeach
                                    @endif
                                    </select>
                                </div>                                                              
                                <div class="col-md-4">
                                    <label>Bank:</label>
                                    <select class="form-control" name="bank" required="required" placeholder="Select Bank">
                                        <option value=""></option>
                                        @foreach($banks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Bank Slip/Cheque No.:</label>
                                    <input type="text" name="chequeno" class="form-control" placeholder="Cheque No." required="required">
                                </div>
                                <div class="col-md-4">
                                    <label>Amount</label>
                                    <input type="number" name="amount" id="amount" class="form-control" placeholder="Amount" required="required">
                                </div>  
                                <div class="col-md-4">
                                    <label>Date of Payment:</label>
                                    <input type="text" name="paydate" class="form-control form-control-inline date-picker" data-date-format="dd-mm-yyyy" >
                                </div>
                                <div class="col-md-4">
                                    <label>Term:</label>
                                    <select name="term" class="form-control" required="required">
                                        <option value=""></option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Year:</label>
                                    <input type="text" name="year" class="form-control form-control-inline" value="{{ date('Y') }}">
                                </div>
                            <div class="col-md-12"><br><br></div>
                                <div class="col-md-12 form-actions fluid">
                                    <div class="col-md-offset-4 col-md-6">
                                        <br><br>
                                        <input type="submit" name="complete" onclick="return checkTotal()" class="btn blue" value="Complete"> &nbsp; &nbsp;
                                        <input type="reset" name="clear" class="btn" value="Clear">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                <div class="tab-pane" id="tab_5_2">
                    <div class="well dark_green">
                        <div class="row">
                        {{ Form::open(array('method' => 'POST', 'files' => true, 'url' => 'finance/accounts/invoice')) }}
                            <div class="col-md-12 form-group">
                                <br>
                                <h4 class="form-section">Invoice Student School Fees<br></h4>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <labe>Class:</labe>
                                        <select class="form-control input-medium" name="invclass" placeholder="Class">
                                            <option></option>
                                            @foreach($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Term:</label>
                                        <select class="form-control input-medium" id="" placeholder="Term" name="invterm">
                                            <option></option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <labe>Year:</labe>
                                        <input type="number" class="form-control input-medium" name="invyear" value="{{ date('Y') }}" min="2010">
                                    </div>
                                    
                                </div>
                                
                                <div class="col-md-12 form-actions fluid">
                                    <br><br>
                                    <div class="col-md-offset-4 col-md-9">
                                        <input type="submit" name="invoice" value="Invoice All" class="btn blue">
                                        <input type="reset" name="clear" class="btn" id="clear" value="Clear">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
<!--                    </div>-->
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
                