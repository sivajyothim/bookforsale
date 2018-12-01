<div class="font-13">2018 © <b><?php echo PROJECT_NAME; ?></b> </div>
               
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
                <script src="<?php echo ADMIN_VENDOR_PATH;  ?>jquery/dist/jquery.min.js"></script>

 <script type="text/javascript">

 	$(document).ready(function(){


    $("#datatable #checkall").click(function () {
        if ($("#datatable #checkall").is(':checked')) {
            $("#datatable input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("#datatable input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});

 	function updateStatus(s,t)
{
    var data_array=new Array();
    $('input[name="multiple[]"]:checked').each(function(){data_array.push($(this).val());});
    var checklist=""+data_array;
    if(!isNaN(s) && (s=='1' || s=='0' || s=='5') && checklist!='')
    {
        $('.statusActivate,.statusDisable').prop('disabled',true);
         $.ajax({
             dataType:'JSON',
             method:'POST',
             data:JSON.stringify({'table':t,'status':s,'inputdata':checklist}),
             url:'<?php echo ADMIN_LINK;?>Welcome/modulesstatuschange',
             success:function(w){
                 console.log(w);
                    switch(w.code)
                    {
                        case 200:
                            $('.display_message_class').html(w.description).addClass('alert alert-success');
                            break;
                        case 204:
                        case 301:
                        case 422:
                        case 575:
                         $('.display_message_class').html(w.description).addClass('alert alert-danger');
                            break;
                    }
                 setTimeout(function(){window.location=location.href;},3000);
             },
              error:function(e){console.log(e);$('.display_message_class').html(e).addClass('alert alert-warning');}
         });
    }
    else
      {
            $('.display_message_class').html('* Please choose atleast one checkbox').addClass('alert alert-warning fade in');
            setTimeout(function(){$('.display_message_class').html('').removeClass('alert alert-warning fade in');},2000);
       }
}
 </script>               