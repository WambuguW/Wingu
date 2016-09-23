@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
Wingu Client 1.0 || Fees Paid & Balances
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
                    <i class="fa fa-globe"></i>Fees Paid & Balances
                </div>
            </div>

            <div class="portlet-body dark_green">
                <div class="tabbable-custom ">
                    <ul class="nav nav-tabs ">
                        <li class="active">
                            <a href="#tab_5_1" data-toggle="tab">
                                Fees Paid
                            </a>
                        </li>
                        <li>
                            <a href="#tab_5_2" data-toggle="tab">
                                Fees Balances
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

                                    {{ Form::open(array('method' => 'POST', 'url' => 'finance/reports/paid')) }}

                                    <div class="col-md-6">
                                        <label>Term:</label><br>
                                        <select name="term" data-placeholder="Select Term" class="form-control input-medium" required="required" id="term"  >
                                            <option></option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Year:</label>
                                        <input type="number" value="{{ date('Y') }}" name="year" class="form-control input-medium" placeholder="Year" min="2010">
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
                        <div class="tab-pane" id="tab_5_2">
                            <div class="well dark_green">
                                <div class="row">

                                    {{ Form::open(array('method' => 'POST', 'url' => 'finance/reports/balances')) }}

                                    <div class="col-md-6">
                                        <label>Term:</label><br>
                                        <select name="bterm" data-placeholder="Select Term" class="form-control input-medium" required="required" id="term"  >
                                            <option></option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Year:</label>
                                        <input type="number" value="{{ date('Y') }}" name="byear" class="form-control input-medium" placeholder="Year" min="2010">
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
