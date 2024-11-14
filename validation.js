
const sendMessage = (id) => {
    $('#succ-msg-alert'+id).html('');
    $('#fail-msg-alert'+id).html('');
    
    var e_name = $('#e_name'+id).val();
    var e_email = $('#e_email'+id).val();
    var e_message = $('#e_message'+id).val();
    
    let isValid = true;
   
    if(isValid){
     //api call here
      $("#add-submit").prop("disabled", true);
    $.ajax({
      url: 'http://192.168.70.177/portfolio/ajax-mail.php',
      type: 'POST',
      data:{
      name:e_name,
      email:e_email, 
      message:e_message,

      action:"add_enquiry", 
      referer:"ezioaws"
    },
      success: function(data){
      $("#add-submit").prop("disabled", false);
        var data = JSON.parse(data);
        if(data.status=="Success"){
         $("#succ-msg-alert" + id).html(data.message);
         $("#fail-msg-alert" + id).html('');
      // setInterval('location.reload()',2000);
              document.getElementById("e_name" + id).value='';
              document.getElementById("e_email" + id).value='';
              document.getElementById("e_message" + id).value='';
             
              setTimeout(function() {
                // document.getElementById("close_btn").click();
                $("#succ-msg-alert" + id).html("");
            }, 2000);
        }
        
        else
       {
        // alert(data.message);
         $("#succ-msg-alert" + id).html("");
          $("#fail-msg-alert" + id).html(data.message);
          //  window.location.reload();
       } 
      },  
    });  
  }
};