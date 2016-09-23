<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="container">
<!--            <div class="content">-->
                <div class="col-md-12">
                <div class="col-md-5">
                    <form class="form-inline" action="" method="POST">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group col-md-12">
                            <div class="col-md-6">
                                <label for="">Make</label><br>
                                <select name="first" id="first" class="form-control">
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Model</label><br>
                                <select name="second" id="second" class="form-control">
                                  <option>--Options--</option>                        
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-6">
                            <label for="">Price From</label><br>
                          <select name="pricefrom" id="pricefrom" class="form-control">
                            <option>--Options--</option>                        
                            </select>
                            </div>
                            <div class="col-md-6">
                            <label for="">Price To</label><br>
                          <select name="priceto" id="priceto" class="form-control">
                            <option>--Options--</option>                        
                            </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-6">
                            <label for="">Fuel</label><br>
                          <select name="fuel" id="fuel" class="form-control">
                              <option>-----</option>
                              <option>Petrol</option>
                            <option>Diesel</option>
                            </select>
                            </div>
                            <div class="col-md-6">
                            <label for="">Condition</label><br>
                          <select name="condition" id="condition" class="form-control">
                            <option>--Options--</option>                        
                            </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-6">
                            <label for="">Year of Manufacture</label><br>
                          <select name="mfgyear" id="mfgyear" class="form-control">
                            <option>--Options--</option>                        
                            </select>
                            </div>
                            <div class="col-md-6">
                            <label for="">Transmission</label><br>
                          <select name="transmission" id="transmission" class="form-control">
                              <option>----</option>
                              <option>Automatic</option>                        
                            <option>Manual</option> 
                            </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-lg">Search</button>
                            </div>
                        </div>
                      </form>
                </div>
                <div class="col-md-7">
                    <ul class="nav nav-tabs">
                        <li role="presentation" class="active" ><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Brands</a></li>
                        <li role="presentation" ><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Body Types</a></li>
                    </ul>
                    
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <a href=""><img src=""></a>
                                </div>
                                <div class="col-md-3">
                                    <a href=""><img src=""></a>
                                </div>
                                <div class="col-md-3">
                                    <a href=""><img src=""></a>
                                </div>
                                <div class="col-md-3">
                                    <a href=""><img src=""></a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <a href=""><img src=""></a>
                                </div>
                                <div class="col-md-3">
                                    <a href=""><img src=""></a>
                                </div>
                                <div class="col-md-3">
                                    <a href=""><img src=""></a>
                                </div>
                                <div class="col-md-3">
                                    <a href=""><img src=""></a>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <a href=""><img src=""></a>
                                </div>
                                <div class="col-md-3">
                                    <a href=""><img src=""></a>
                                </div>
                                <div class="col-md-3">
                                    <a href=""><img src=""></a>
                                </div>
                                <div class="col-md-3">
                                    <a href=""><img src=""></a>
                                </div>
                            </div>
                        </div>
                      </div>

                </div>
                    </div>
<!--            </div>-->
        </div>
        <script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/admin/js/bootstrap.js') }}"></script>
        <!--<script type="text/javascript" src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>-->
        <!--<script type="text/javascript" src="{{ asset('assets/admin/js/bootstrap.js') }}"></script>-->
        <script type="text/javascript">
            $(document).ready(function ($) {
                $('.nav-tabs').tab('show');
            });
        </script>
        <script>
            $(document).ready(function (){
                $('#first').change(function(){
                    var selected = $('#first').val();
                    var token = $('#_token').val();
                    $('#second').attr('disabled', 'disabled');
                    $.ajax(
                            {
                                type: "POST",
                                url: "{{ url('ajax/request') }}",
                                data: {'selected': selected, '_token': $('input[name=_token]').val()},
                                cache: false,
                                success: function(data){
                                    $('#second').empty();
                                    $('#second').append("<option>--Select Option--</option>");
                                    $.each(data, function(){
                                        $('#second').append("<option value='" + this.id + "'>" + this.username + "</option>" );
                                    });
                                    $('#second').removeAttr('disabled');
                                    }
                            });
                });
                
            });
        </script>
    </body>
</html>
