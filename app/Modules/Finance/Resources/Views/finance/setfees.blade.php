@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
Wingu Client 1.0 || Fees Structure
@endsection



<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
Fees Structure
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
                    <i class="fa fa-globe"></i>Fees Structure
                </div>
            </div>

            <div class="portlet-body dark_green">
                <div class="tabbable-custom ">
                    <ul class="nav nav-tabs ">
                        <li class="active">
                            <a href="#tab_5_1" data-toggle="tab">
                                Make Fee Structure
                            </a>
                        </li>
                        <li>
                            <a href="#tab_5_2" data-toggle="tab">
                                View Fees Structure
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

                                    {{ Form::open(array('url' => 'finance/setfees','method' => 'POST')) }}
                                    <div class="col-md-6">
                                        <label>Select Term</label>
                                        <select name="term" data-placeholder="Select Term" class="form-control select2me" required="required" id="country_list" id="select2_sample4"   >
                                            <option></option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Year</label>
                                        <input type="number" name="year" value="2016" min="2012" class="form-control" placeholder="Year" required="required">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Class:</label>
                                        <select name="class" class="form-control input-medium" required="required" placeholder="Select Class">
                                            <option></option>
                                            @foreach($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--                                                <div class="col-md-6">
                                                                                        <label>Amount</label>
                                                                                        <input type="number" name="amount" id="amount" class="form-control" placeholder="Total Amount" required="required">
                                                                                    </div>-->
                                    <div class="col-md-6">

                                    </div><br><br>
                                    <div class="col-md-12">
                                        <p>Click on 'Add' on the accounts on the right to add them to the fees structure</p> <br><br>
                                    </div>
                                    <div class="col-md-12">                                              
                                        <div class="col-md-8" id="feestructure">
                                            <table id="feestructuredetails" class="table table-striped table-bordered table-hover table-full-width">
                                                <tr><th colspan="2"><center>FEES STRUCTURE</center></th></tr>
                                                <tr><th>Account</th><th>Amount</th></tr>                                                        
                                            </table>
                                        </div>
                                        <div class="col-md-4" id="scfeesaccounts">
                                            <table id="scfaccounts" class="table table-striped table-bordered table-hover table-full-width">
                                                <tr><th colspan="3"><center>School Fees Sub-Accounts</center></th></tr>
                                                <tr><th>ID</th><th>Account</th><th>Action</th></tr>
                                                @foreach($fees_accounts as $account)
                                                <tr><td>{{ $account->id }}</td><td>{{ $account->name }}</td><td><span class="btn badge blue" id="addtofeestructure"><i class="fa fa-arrow-left"></i>Add</span></td></tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-actions fluid">
                                        <div class="col-md-offset-4 col-md-9">
                                            <br><br>
                                            <input type="submit" name="complete" onclick="return checkTotal()" class="btn blue" value="Complete"> &nbsp; &nbsp;
                                            <input type="reset" name="clear" class="btn" value="Clear">
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_5_2">
                            <div class="well dark_green">
                                <div class="row">

                                    {{ Form::open(array('method' => 'POST', 'url' => 'finance/feestructure')) }}

                                    <div class="col-md-6">
                                        <label>Term:</label><br>
                                        <select name="fterm" data-placeholder="Select Term" class="form-control input-medium" required="required" id="term"  >
                                            <option></option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Year:</label>
                                        <input type="number" value="{{ date('Y') }}" name="fyear" class="form-control input-medium" placeholder="Year" min="2010">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Class:</label><br>
                                        <select name="fclass" data-placeholder="Select Class" class="form-control input-medium" required="required" id="class"  >
                                            <option></option>
                                            @foreach($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6" id="newclass">

                                    </div>
                                    <div class="col-md-12 form-actions fluid">
                                        <div class="col-md-offset-4 col-md-9">
                                            <br><br>
                                            <input type="submit" name="complete" class="btn blue" value="View"> &nbsp; &nbsp;
                                            <input type="reset" name="clear" class="btn" value="Clear">
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
