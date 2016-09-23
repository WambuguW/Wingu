@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || Systems Configuration
@endsection



<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
    Register Banks
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
                                                <i class="fa fa-globe"></i>Register Banks
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
                                            
                                            {{ Form::open(array('method' => 'POST')) }}
                                                
                                                    
                                            <div class="col-md-6">
                                                    <label>Bank Name:</label>
                                                    <input type="text" name="bank" id="bankname" placeholder="Bank name" class="form-control input-medium" required="required">
                                                    <br> <br>
                                                </div>
                                            <div class="col-md-6">
                                                    <label>Account No</label>
                                                    <input type="text" name="accno" id="accno" placeholder="Account No" class="form-control input-medium" required="required">
                                                    <br> <br>
                                                </div>
                                            <div class="col-md-6">
                                                    <label>Branch</label>
                                                    <input type="text" name="branch" id="branch" placeholder="Branch" class="form-control input-medium" required="required">
                                                    <br> <br>
                                                </div>
                                            <div class="col-md-6" id="newbank">
                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    <br><br>
                                                    <span class="btn blue" id="addbank">Add Bank</span>&nbsp; &nbsp;
                                                    <input type="reset" name="clear" class="btn" value="Clear">
                                                </div>
                                            </form> 
                                            <div class="col-md-12">
                                            <table id="response" class="table table-striped table-bordered table-hover table-full-width">
                                                <tr>
                                                    <th>Bank Id</th><th>Bank Name</th><th>Account No</th><th>Branch</th><th>Action</th>
                                                </tr>
                                                    @foreach($banks as $bank)
                                                    <tr><td>{{ $bank->id }}</td><td>{{ $bank->name }}</td><td>{{ $bank->accno }}</td><td>{{ $bank->branch }}</td><td><a href="{{ url('config/banks/delete') }}/{{ $bank->id }}" onclick="return showalert()"><span class="label label-danger label-sm">Delete</span></a></td></tr>
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
                