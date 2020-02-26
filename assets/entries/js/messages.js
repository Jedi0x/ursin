

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
          url: base_url+'exams/exams/delete',
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
        url: base_url+'exams/exams/get_all_exams_data',
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

function checkvalidation_exam(){
  var clsid = document.getElementById("class_id_exm").value;
  if(clsid == ""){
    toastr.error("Please select class");
    return false;  
  }
  
}

function checkvalidation_message(){
  var clsid = document.getElementById("clasid").value;
  if(clsid == ""){
    toastr.error("Please select class");
    return false;  
  }

  if(clsid == ""){
    toastr.error("Please select class");
    return false;  
  }
  
}

function showmailcheckbox(value){
  if(value == 2){
    $("#idofmailcheckbox").show();
  }else{
    $("#idofmailcheckbox").hide();
  }

}