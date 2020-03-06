

$(document).on('click', '.delete-message', function(e){
  var id = $(this).attr('data-id');
  var key = $(this).attr('data-key');
  $.confirm({
    title: 'Delete Message',
    content: 'Do you really want to delete this message permanently?',
    icon: 'fa fa-trash',
    theme: 'supervan',
    closeIcon: true,
    animation: 'scale',
    type: 'orange',
    buttons: {
      Delete: function () {
        $.ajax({
          type: "POST",
          url: base_url+'entries/messages/delete',
          data:{id:id,key:key},
          dataType:'json',
          success: function(data)
          {
            if(data.status){
              location.reload();
            }
          }
        });
      },
      Cancel: function () {}
    }
  });
});


$(document).on('click', '.delete-exam', function(e){
  var id = $(this).attr('data-id');
  var key = $(this).attr('data-key');
  $.confirm({
    title: 'Delete Exam',
    content: 'Do you want to delete this exam definitely?',
    icon: 'fa fa-trash',
    theme: 'supervan',
    closeIcon: true,
    animation: 'scale',
    type: 'orange',
    buttons: {
      Delete: function () {
        $.ajax({
          type: "POST",
          url: base_url+'entries/exams/delete',
          data:{id:id,key:key},
          dataType:'json',
          success: function(data)
          {
            if(data.status){
              location.reload();
            }
          }
        });
      },
      Cancel: function () {}
    }
  });
});


$(document).on('click', '.delete-calendar', function(e){
  var id = $(this).attr('data-id');
  var key = $(this).attr('data-key');
  $.confirm({
    title: 'Delete Calendar',
    content: 'Do you want to delete this event definitely?',
    icon: 'fa fa-trash',
    theme: 'supervan',
    closeIcon: true,
    animation: 'scale',
    type: 'orange',
    buttons: {
      Delete: function () {
        $.ajax({
          type: "POST",
          url: base_url+'entries/calendar/delete',
          data:{id:id,key:key},
          dataType:'json',
          success: function(data)
          {
            if(data.status){
              location.reload();
            }
          }
        });
      },
      Cancel: function () {}
    }
  });
});

$(document).on('click', '.delete-homework', function(e){
  var id = $(this).attr('data-id');
  var key = $(this).attr('data-key');
  $.confirm({
    title: 'Delete Calendar',
    content: 'Do you want to delete this homework definitely?',
    icon: 'fa fa-trash',
    theme: 'supervan',
    closeIcon: true,
    animation: 'scale',
    type: 'orange',
    buttons: {
      Delete: function () {
        $.ajax({
          type: "POST",
          url: base_url+'entries/homework/delete',
          data:{id:id,key:key},
          dataType:'json',
          success: function(data)
          {
            if(data.status){
              location.reload();
            }
          }
        });
      },
      Cancel: function () {}
    }
  });
});


$(document).on('click', '.delete-links', function(e){

  var id = $(this).attr('data-id');
  var key = $(this).attr('data-key');
  $.confirm({
    title: 'Delete Links',
    content: 'Do you want to delete this weblink definitely?',
    icon: 'fa fa-trash',
    theme: 'supervan',
    closeIcon: true,
    animation: 'scale',
    type: 'orange',
    buttons: {
      Delete: function () {
        $.ajax({
          type: "POST",
          url: base_url+'entries/link/delete',
          data:{id:id,key:key},
          dataType:'json',
          success: function(data)
          {
            if(data.status){
              location.reload();
            }
          }
        });
      },
      Cancel: function () {}
    }
  });
});

function load_alldata_teacher(value){
                  

                   var clsid = value;
                   $.ajax({
                    method:'post',
                    url: base_url+'entries/messages/get_all_teacher_data',
                    data:{class_id:clsid},
                    dataType:'json',
                    success:function(res){
                      if(res.status){
                        
                        $('#messagebox').html(res.data);
                      }else{
                         
                      }
                     
                    }
                  });

}


function load_alldata_exams(value){
       var clsid = value;
       $.ajax({
        method:'post',
        url: base_url+'entries/exams/get_all_exams_data',
        data:{class_id:clsid},
        dataType:'json',
        success:function(res){
          if(res.status){
            
            $('#exambox').html(res.data);
          }else{
             
          }
         
        }
      });

}


function load_alldata_calendar(value){
       var clsid = value;
       $.ajax({
        method:'post',
        url: base_url+'entries/calendar/get_all_calendar_data',
        data:{class_id:clsid},
        dataType:'json',
        success:function(res){
          if(res.status){
            
            $('#calendarbox').html(res.data);
          }else{
             
          }
         
        }
      });

}

function load_alldata_homework(value){
       var clsid = value;
       $.ajax({
        method:'post',
        url: base_url+'entries/homework/get_all_homework_data',
        data:{class_id:clsid},
        dataType:'json',
        success:function(res){
          if(res.status){
            
            $('#homeworkbox').html(res.data);
          }else{
             
          }
         
        }
      });

}


function load_homework_data(){
       var clsid = document.getElementById("class_id_showhw").value;
       var filterval = $('input[name="filterdaterange"]:checked').val();

     if(!$( "#btn_change_color" ).hasClass( "colorgrn" )){
       $.ajax({
        method:'post',
        url: base_url+'entries/showhomework/show_homework_data',
        data:{class_id:clsid,filterval:filterval},
        dataType:'json',
        success:function(res){
          if(res.status){
            
            $('#show_homeworkbox').html(res.data);
          }else{
             
          }
         
        }
      });
      }else{
        load_connected_teacher();
      }
}

function load_connected_teacher(){
       var clsid = document.getElementById("class_id_showhw").value;
       var filterval = $('input[name="filterdaterange"]:checked').val();
     
       if(!$( "#btn_change_color" ).hasClass( "colorgrn" )){
              $('#btn_change_color').addClass("colorgrn");
               $('#btn_change_color').removeClass("colorwhite");
              $('#iconid').css("color", "white");
               $.ajax({
                method:'post',
                url: base_url+'entries/showhomework/get_all_homework_data',
                data:{class_id:clsid,filterval:filterval},
                dataType:'json',
                success:function(res){
                  if(res.status){
                    $('#show_homeworkbox').html(res.data);
                  }
                 
                }
              });
         }else{
          $('#btn_change_color').addClass("colorwhite");
          $('#btn_change_color').removeClass("colorgrn");
          $('#iconid').css("color", "green");
          load_homework_data();
         }

}

function load_alldata_links(value){
       var clsid = value;
       $.ajax({
        method:'post',
        url: base_url+'entries/link/get_all_link_data',
        data:{class_id:clsid},
        dataType:'json',
        success:function(res){
          if(res.status){
            
            $('#linkbox').html(res.data);
          }else{
             
          }
         
        }
      });

}




function checkvalidation_exam(){
  var clsid = document.getElementById("class_id_exm").value;
  if(clsid == ""){
    toastr.error("Please select a class");
    return false;  
  }
  
}

function checkvalidation_message(){
  var clsid = document.getElementById("clasid").value;
  if(clsid == ""){
    toastr.error("Please select a class");
    return false;  
  }
  
}

function checkvalidation_calendar(){
  var clsid = document.getElementById("class_id_calendar").value;
  if(clsid == ""){
    toastr.error("Please select a class");
    return false;  
  }
  
}

function checkvalidation_homework(){
  var clsid = document.getElementById("clasid_homework").value;
  if(clsid == ""){
    toastr.error("Please select a class");
    return false;  
  }
  
}

function checkvalidation_links(){
  var clsid = document.getElementById("clasid_link").value;
  var urlid = document.getElementById("urlid").value;

  if(clsid == ""){
    toastr.error("Please select a class");
    return false;  
  }
   if (!urlid.match(/^http?:/)) {
          
    toastr.error("Please start URLs with https://, http:// or www. Change entries that start with www by http://www");
    return false;  
   }
  
}

function changecolor(colorcode){
  $('#colorset').val(colorcode);

  $('#setboxcolor').css('background',colorcode);
  
}



function showmailcheckbox(value){
  if(value == 2){
    $("#idofmailcheckbox").show();
  }else{
    $("#idofmailcheckbox").hide();
  }

}



/////////////////////////////  Absent //////////////////////
  
  function callabsnet_stuendts(){
       var clsid = document.getElementById("class_id_absent").value;
       
         $.ajax({
          method:'post',
          url: base_url+'entries/absent/show_students',
          data:{class_id:clsid},
          dataType:'json',
          success:function(res){
            if(res.status){
              
              $('#show_students').html(res.data);
            }else{
               
            }
           
          }
        });
        
  }

  function abset_mark(student_id, flag,indexofabsent){

        $.ajax({
          method:'post',
          url: base_url+'entries/absent/mark_absent',
          data:{student_id:student_id,flag:flag,indexofabsent:indexofabsent},
          dataType:'json',
          success:function(res){
            if(res.status){
              
             toastr.success("Successfully updated");  
            }else{
               
            }
           
          }
        });
  }



  function all_present_mark(student_id){
        var clsid = document.getElementById("class_id_absent").value;
        if(clsid != ''){
          $.ajax({
            method:'post',
            url: base_url+'entries/absent/get_all_student_present',
            data:{class_id:clsid},
            dataType:'json',
            success:function(res){
              if(res.status){
                
                $('#show_students').html(res.data);
              }else{
                 
              }
             
            }
          });
        }else{
           toastr.error("Please select a class");
        }
  }

///////////