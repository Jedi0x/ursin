

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


function showmailcheckbox(value){
  if(value == 2){
    $("#idofmailcheckbox").show();
  }else{
    $("#idofmailcheckbox").hide();
  }

}