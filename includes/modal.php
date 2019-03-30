<div class="modal fade" role="dialog" tabindex="-1" id="preview">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Logout</h1><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                <div class="modal-body">
                    <div class="d-inline">
                        <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-1" name="all"><label class="form-check-label" for="formCheck-1">Logout of All Devices</label></div>
                    </div>
                </div>
                <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" role="button" id="logout">Logout</a></div>
            </div>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){  
   /* $('#logout').click(function(){
        window.alert("Clicked");
      });*/

      $('#logout').click(function(){
        $.ajax({  
                     url:"OUT/logout1.php",  
                     method:"POST",  
                     data: {all:all},  
                     success:function(data)  
                     {  
                          window.location.reload();
                     }  
            });  
      });  
      


    });
</script>