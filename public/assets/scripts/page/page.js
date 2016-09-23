
        $('#class').change(function(){
                var class_id = $('#class').val();
                $.ajax(
                {
                        type:"GET",
                        url: "exams/classes/selected",
                        data: {'class_id': class_id, '_token': $('input[name=_token]').val()},
                        cache: false,
                        success: function(data) {
                                $('#admno').empty();
                                $.each(data, function(){
                                    $('#admno').append("<option value='"+this.admno+"'>" + this.surname + ", " + this.fname + " " + this.lname + "</option>");
                                });
                        }
                });
        });
        
        
            $(document).ready(function(){
                $('#examscheck').click(function(){
                var term = $('#term').val();
                var exam = $('#exam').val();
                var token = $('#examform > input[name="_token"]').val();
                var adm = 721;
                $.ajax(
                        {
                            type: "GET",
                            url: "students/profile/examhistory",
                            data: {'term': term, 'exam': exam, 'admnum': adm, '_token': $('input[name=_token]').val()},                             
                            cache: false,
                            success: function(data){
                                $('#examresults').empty(); 
                                alert(data);
                            }
                        }
                        );
            });
            });
            
            
        
        
            $(document).ready(function(){
               $('#addclass').click(function(){
                var classname = $('#classname').val();
                $.ajax(
                        {
                            type: "POST",
                            url: "classes",
                            data: {'classname': classname, '_token': $('input[name=_token]').val()},
                            cache: false,
                            success: function(data){
                                $('#response').empty();
                                $('#response').append("<tr><th>Class ID</th><th>Class Name</th><th>Action</th></tr>");
                                $.each(data, function(){
                                        $('#response').append("<tr><td>"+this.id+"</td><td>" + this.name + "</td><td><a href='classes/delete/" + this.id + "' onclick='return showalert()'><span  class='label label-danger label-sm'>Delete</span></a></td></tr>");
                                    });
                                }
                        });
                    }); 
            
        });
            
        
        
            $(document).ready(function(){
               $('#addsubject').click(function(){
                var subjectcode = $('#subjectcode').val();
                var subjectname = $('#subjectname').val();
                $.ajax(
                        {
                            type: "POST",
                            url: "{{ url('config/subjects') }}",
                            data: {'subjectcode': subjectcode, 'subjectname': subjectname, '_token': $('input[name=_token]').val()},
                            cache: false,
                            success: function(data){
                                $('#response').empty();
                                $('#response').append("<tr><th>Subject Code</th><th>Subject Name</th><th>Action</th></tr>");
                                $.each(data, function(){
                                        $('#response').append("<tr><td>"+this.code+"</td><td>" + this.name + "</td><td><a href='subjects/delete/" + this.id+"'><span  class='label label-danger label-sm'>Delete</span></a></td></tr>");
                                    });
                                }
                        });
                    }); 
            
        });
            
        
        
            $(document).ready(function(){
               $('#addstream').click(function(){
                var streamname = $('#streamname').val();
                $.ajax(
                        {
                            type: "POST",
                            url: "{{ url('config/streams') }}",
                            data: {'streamname': streamname, '_token': $('input[name=_token]').val()},
                            cache: false,
                            success: function(data){
                                $('#streamname').attr('value', '');
                                $('#response').empty();
                                $('#response').append("<tr><th>Stream ID</th><th>Stream Name</th><th>Action</th></tr>");
                                $.each(data, function(){
                                        $('#response').append("<tr><td>"+this.id+"</td><td>" + this.name + "</td><td><a href='streams/delete/" + this.id+"'><span  class='label label-danger label-sm'>Delete</span></a></td></tr>");
                                    });
                                }
                        });
                    }); 
            
        });
            
        
        
            $(document).ready(function(){
               $('#addexam').click(function(){
                var examname = $('#examname').val();
                var outof = $('#outof').val();
                $.ajax(
                        {
                            type: "POST",
                            url: "{{ url('config/exams') }}",
                            data: {'examname': examname, 'outof': outof, '_token': $('input[name=_token]').val()},
                            cache: false,
                            success: function(data){
                                $('#examname').attr('value', '');
                                $('#outof').attr('value', '');
                                $('#response').empty();
                                $('#response').append("<tr><th>Exam Id</th><th>Exam Name</th><th>Out of</th><th>Action</th></tr>");
                                $.each(data, function(){
                                        $('#response').append("<tr><td>"+this.id+"</td><td>" + this.name + "</td><td>" + this.outof + "</td><td><a href='exams/delete/" + this.id+"'><span  class='label label-danger label-sm'>Delete</span></a></td></tr>");
                                    });
                                }
                        });
                    }); 
            
        });
            
        
        
            $(document).ready(function(){
               $('#adddorm').click(function(){
                var dormname = $('#dormitory').val();
                var capacity = $('#capacity').val();
                var sex = $('#sex').val();
                $.ajax(
                        {
                            type: "POST",
                            url: "{{ url('config/dorms') }}",
                            data: {'dormname': dormname, 'capacity': capacity, 'sex': sex, '_token': $('input[name=_token]').val()},
                            cache: false,
                            success: function(data){
                                $('#dormitory').attr('value', '');
                                $('#sex').attr('value', '');
                                $('#capacity').attr('value', '');
                                $('#response').empty();
                                $('#response').append("<tr><th>Dorm Name</th><th>Sex</th><th>Capacity</th><th>Action</th></tr>");
                                $.each(data, function(){
                                        $('#response').append("<tr><td>"+this.name+"</td><td>" + this.sex + "</td><td>" + this.capacity + "</td><td><a href='delete/" + this.id+"'><span  class='label label-danger label-sm'>Delete</span></a></td></tr>");
                                    });
                                }
                        });
                    }); 
            
        });
            
        
        
            $(document).ready(function(){
                $('#fromclass').change(function (){
                    var classs = $('#fromclass').val();
                    $.ajax(
                            {
                                type: "POST",
                                url: "class/students",
                                data: {'classs': classs, '_token': $('input[name=_token]').val()},
                                cache: false,
                                success: function(data){
                                    $('#classstudents').empty();
                                    $('#classstudents').append("<tr><th>Student Name</th><th>Student Adm</th><th>Select</th></tr>");
                                    if(data === '0'){
                                        alert('Please select a class or register students to that class');
                                    } else {
                                    $.each(data, function(){
                                            $('#classstudents').append("<tr><td>"+this.surname.toUpperCase() + ", " + this.fname + " " + this.lname + "</td><td>" + this.admno + "</td><td><input type='checkbox' class='checkboxes' name='std_group[]' value='" + this.admno + "'></td></tr>");
                                        });
                                        $('#classstudents').append("<input type='hidden' name='currclass' value='" + classs + "'>");
                                        $('#subm').html("<input type='submit' class='btn blue' value='Graduate Selected'>");
                                    }
                                }
                            });

                });    
        
            });
        
        
        $(document).ready(function(){
            $('#pushtoclass').click(function (){
                var former = $('#fromclass').val();
                $.ajax({
                    type: "POST",
                    url: "{{ url('students/class/nextclass') }}",
                    data: {'former': former, '_token': $('input[name=_token]').val()},
                    cache: false,
                    success: function (data){
                        alert(data);
                    }
                });
            });
        });    
        
        
            $(document).ready(function(){
                $('#gender').change(function(){
                    var thegender = $('#gender').val();
                    //var thegender = $('select[name = sex]:selected').val();
                    
                    $.ajax({
                        type: "POST",
                        url: "search/dorm/gender",
                        data: {'thegender': thegender, '_token': $('input[name=_token]').val()},
                        cache: false,
                        success: function(data){
                            $('#dormitoryname').empty();
                            $('#dormitoryname').append("<option></option>");
                            $.each(data, function(){
                                $('#dormitoryname').append("<option value='" + this.id + "'>" + this.name + "</option>");
                            });
                        }
                    });
                });
            });
            
        
            $(document).ready(function(){
               $('#addnewuser').click(function(){
                var newuser = $('#newuser').val();
                var email = $('#email').val();
                var userrole = $('#userrole').val();
                var userstatus = $('#userstatus').val();
                $.ajax(
                        {
                            type: "POST",
                            url: "{{ url('admin/users') }}",
                            data: {'newuser': newuser, 'email': email, 'userrole': userrole, 'userstatus': userstatus, '_token': $('input[name=_token]').val()},
                            cache: false,
                            success: function(data){
                                $('#response').empty();
                                $('#response').append("<tr><th>User ID</th><th>User Name</th><th>Email</th><th>Status</th><th>Action</th></tr>");
                                $.each(data, function(){
                                    if(this.status === 'Active'){
                                        $('#response').append("<tr><td>"+this.id+"</td><td>" + this.username + "</td><td>" + this.email + "</td><td>" + this.status + "</td><td><span class='btn btn-warning btn-xs'>Suspend</span><a href='"+"{{ url('admin/users/delete/" + this.id+"')}}' onclick='return showalert()'><span  class='btn btn-danger btn-xs'>Delete</span></a></td></tr>");
                                    } else{
                                        $('#response').append("<tr><td>"+this.id+"</td><td>" + this.username + "</td><td>" + this.email + "</td><td>" + this.status + "</td><td><span class='btn btn-success btn-xs'>Activate</span><a href='"+"{{ url('admin/users/delete/" + this.id+"')}}' onclick='return showalert()'><span  class='btn btn-danger btn-xs'>Delete</span></a></td></tr>");
                                    }                                        
                                    });
                                }
                        });
                    }); 
            
            });
            
        
        
        
            $(document).ready(function(){
               $(document).on('change','#theadmno', function(e){
                   e.preventDefault();
                   var admno = $('#theadmno').val();
                   var term = $('#theterm').val();
                   var exam = $('#theexam').val();
                   var year = $('#theyear').val();
                   var classe = $('#classe').val();
                $.ajax(
                        {
                            type: "POST",
                            url: "{{ url('exams/individualresults/next') }}",
                            data: {'admno': admno, 'term': term, 'exam': exam, 'year': year, 'classe': classe, '_token': $('input[name=_token]').val()},
                            cache: false,
                            success: function(data){
                                var source = $(''+ data +'');
                                //$('#printresults').empty();
                                $('#printresults').html(source.find('#stdresults').html());
                                
                                }
                        });
                    }); 
            
            });
            
        
        
        
        $(document).ready(function(){
            $('#next').click(function(){
                $('#theadmno').val($('#theadmno > option:selected').next().val());
                   var admno = $('#theadmno').val();
                   var term = $('#theterm').val();
                   var exam = $('#theexam').val();
                   var year = $('#theyear').val();
                   var classe = $('#classe').val();
                $.ajax(
                        {
                            type: "POST",
                            url: "{{ url('exams/individualresults/next') }}",
                            data: {'admno': admno, 'term': term, 'exam': exam, 'year': year, 'classe': classe, '_token': $('input[name=_token]').val()},
                            cache: false,
                            success: function(data){
                                var source = $(''+ data +'');
                                //$('#printresults').empty();
                                $('#printresults').html(source.find('#stdresults').html());
                                
                                }
                        });
            });
        });
        
        
        
        $(document).ready(function(){
            $('#previous').click(function(){
                $('#theadmno').val($('#theadmno > option:selected').prev().val());
                   var admno = $('#theadmno').val();
                   var term = $('#theterm').val();
                   var exam = $('#theexam').val();
                   var year = $('#theyear').val();
                   var classe = $('#classe').val();
                $.ajax(
                        {
                            type: "POST",
                            url: "{{ url('exams/individualresults/next') }}",
                            data: {'admno': admno, 'term': term, 'exam': exam, 'year': year, 'classe': classe, '_token': $('input[name=_token]').val()},
                            cache: false,
                            success: function(data){
                                var source = $(''+ data +'');
                                //$('#printresults').empty();
                                $('#printresults').html(source.find('#stdresults').html());
                                
                                }
                        });
            });
        });
        
        
        
        $(document).ready(function(){
            $('#addaccount').click(function(){
                   var accname = $('#accname').val();
                   var accode = $('#accode').val();
                   var accstatus = $('#accstatus').val();
                   var acctype = $('#acctype').val();
                   if(accname === '' || accode === '' || accstatus === '' || acctype === ''){
                       alert("Please fill in all fields!");
                   } else{
                       $.ajax(
                        {
                            type: "POST",
                            url: "{{ url('finance/accounts') }}",
                            data: {'accname': accname, 'accode': accode, 'accstatus': accstatus, 'acctype': acctype, '_token': $('input[name=_token]').val()},
                            cache: false,
                            success: function(data){
                                $('#accstable').empty();
                                $('#accsoptions').empty();
                                $('#accsoptions').append("<option></option>");
                                $('#accstable').append("<tr><th>Account Name</th><th>Account Code</th><th>Status</th></tr>");
                                $('#accname').attr('value', '');
                                $('#accode').attr('value', '');
                                $('#accstatus').attr('value', '');
                                $('#acctype').attr('value', '');
                                $.each(data, function(){
                                    $('#accstable').append("<tr><td>"+this.name +"</td><td>" + this.accode + "</td><td>" + this.status + "</td></tr>");
                                });
                                $.each(data, function(){
                                    $('#accsoptions').append("<option value='" + this.accode + "'>" + this.name + "</option>" );
                                });
                                alert("Done");
                                }
                        });
                   }
                
            });
        });
        
        
        
            $(document).ready(function (){
                $('#addnewaccfunction').click(function (){
                    var funcaccdivision = $('#accfuncdivision').val();
                    var funcaccdescription = $('#accfuncdescription').val();
                    var funcaccname = $('#accfunctionname').val();
                    if(funcaccdivision === '' || funcaccdescription === '' || funcaccname === ''){
                        alert('Please fill out all fields!');
                    } else {
                        $.ajax(
                            {
                                type: "POST",
                                url: "{{ url('finance/accounts/functions') }}",
                                data: {'funcaccdivision': funcaccdivision, 'funcaccdescription': funcaccdescription, 'funcaccname': funcaccname, '_token': $('input[name=_token]').val()},
                                cache: false,
                                success: function(data){
                                    //$('#accfuncdivision').empty();
                                    $('#accfuncdescription').attr('value', '');
                                    $('#accfunctionname').attr('value', '');
                                    $('#accfuncoptions').empty();
                                    $('#accname').attr('value', '');
                                    $('#accode').attr('value', '');
                                    $('#accstatus').attr('value', '');
                                    $('#accfunctionstable').empty();
                                    $('#accfunctionstable').append("<tr><th>Function Name</th><th>Division</th></tr>");
                                    $('#accfuncoptions').append("<option></option>");
                                    $.each(data, function(){
                                        $('#accfunctionstable').append("<tr><td>"+this.name +"</td><td>" + this.division_id + "</td></tr>");
                                    
                                        $('#accfuncoptions').append("<option value='"+this.id +"'>" + this.name + "</option>");
                                    });
                                    alert("Done");
                                    }
                            });
                        }
                });
            });
        
        
        
            $(document).ready(function (){
                $('#addnewacctype').click(function (){
                    var accfunc = $('#accfuncoptions').val();
                    var acctypename = $('#acctypename').val();
                    var acctypedescription = $('#acctypedescription').val();
                    if(accfunc === '' || acctypename === '' || acctypedescription === ''){
                        alert('Please fill out all fields!');
                    } else {
                        $.ajax(
                            {
                                type: "POST",
                                url: "{{ url('finance/accounts/types') }}",
                                data: {'accfunc': accfunc, 'acctypename': acctypename, 'acctypedescription': acctypedescription, '_token': $('input[name=_token]').val()},
                                cache: false,
                                success: function(data){
                                    $('#acctypedescription').attr('value', '');
                                    $('#acctypename').empty();
                                    $('#acctype').empty();
                                    $('#acctype').append("<option></option>");
                                    $('#acctypestable').empty();
                                    $('#acctypestable').append("<tr><th>Type</th><th>Description</th><th>Function</th></tr>");
                                    $('#acctypename').attr('value', '');
                                    $('#accfuncoptions').attr('value', '');
                                    $('#accode').attr('value', '');
                                    $('#accstatus').attr('value', '');
                                    $.each(data, function(){
                                        $('#acctypestable').append("<tr><td>"+this.name +"</td><td>" + this.description + "</td><td>" + this.function + "</td></tr>");
                                    });
                                    $.each(data, function(){
                                        $('#acctype').append("<option value='" + this.id + "'>" + this.name + "</option>" );
                                    });
                                    alert("Done");
                                    }
                            });
                        }
                });
            });
        
        
        
        $(document).ready(function(){
            $('#scfaccounts').find('tr').click(function(){
                var theid = $(this).find('td:first').text();
                var theacc = $(this).find('td:nth-child(2)').text();
                if(theid === '' || theacc === ''){
                    
                } else{
                    $('#feestructuredetails tr:last').after("<tr><td><input type='hidden' name='accids[]' value='" + theid + "'>" + theacc + "</td><td><input type='number' min='0' id='breakdowns' name='accamounts[]' class='form-control input-medium'></td></tr>");
                    $(this).remove();
                }
            });
        });
        