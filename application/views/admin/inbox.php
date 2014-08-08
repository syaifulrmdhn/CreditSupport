<style>
    .header-msg{ 
        background-color: #efefef;
        width: 780px;
    }
    .header-msg label{
        font-weight: bold;
    }
    fieldset label{
        position: relative;
        float: left;
        width: 120px;
    }
    fieldset{
        position: relative;
        float: left;
        width: 780px;
        border: 1px solid #eee;
        padding: 20px;
    }
</style>
<?php 
if(strpos(uri_string(), 'view_')){
?>   
<fieldset>
    <a class="btn" href="<?php echo base_url();?>admin/message/reply_to_all/<?php echo $msg_detail->id;?>"><i class="icon-share-alt"></i> Reply to ALL</a>
    <a class="btn" href="#"><i class="icon-arrow-right"></i> Forward</a>
    <a class="btn pull-right" onClick="confirm_delete2('<?php echo $msg_detail->id;?>')"><i class="icon-trash"></i> Delete</a>
</fieldset>
<fieldset class="header-msg">
    <p><label>Sender</label> : <?php echo $msg_detail->from;?></p>
    <p><label>Subject</label> : <?php echo $msg_detail->subject;?></p>
    <p><label>Date</label> : <?php echo $msg_detail->date;?></p>
</fieldset>
<fieldset>
    <label><?php echo $msg_detail->body;?></label>
</fieldset>
<fieldset style="margin-top: 20px;">
    <h4>Quick Reply</h4>
    <form class="form-horizontal" action="<?php echo base_url();?>admin/message/send_message" method="POST">
        <div class="control-group">
            <label class="control-label">Subject</label>
            <div class="controls">
                <input type="hidden" name="receiver" value="<?php echo $msg_detail->from;?>">
                <input type="text" name="subject" value="Re: <?php echo $msg_detail->subject?>">
            </div>
        </div>
        <div class="control-group">
        <label class="control-label">Body : </label>
        <div class="controls">
            <textarea class="textarea" id="some-text" name="some-text" style="width:500px; height:100px;" placeholder="Type your message here ..."></textarea>
        <br>
        <br>
        <button class="btn btn-primary">Send</button>
        <a class="btn" href="<?php echo base_url();?>admin/message">Cancel</a>
        </div>   
    </div>    
    </form>
</fieldset>

<?php    
}else{
echo 'paging : ';
echo $this->pagination->create_links();
?>
<form action="<?php echo base_url();?>admin/message/delete_inbox" method="POST" id="delete_submit">
<table class="table">
    <thead><th>&nbsp;</th><th>Sender</th><th>Subject</th><th>Date</th></thead>
    <tbody>
    <?php 
    foreach($messages as $msg){
        if($msg->viewed == 1){
        echo '<tr><td><input type="checkbox" name="delete_msg[]" value="'.$msg->id.'"></td>
             <td>'.$msg->from.'</td>
             <td><a href="'.base_url().'admin/message/view_inbox/'.$msg->id.'">'.$msg->subject.'</a></td>
             <td>'.$msg->date.'</td></tr>';
        }else{
            echo '<tr style="font-weight:bold"><td><input type="checkbox" name="delete_msg[]" value="'.$msg->id.'"></td>
             <td>'.$msg->from.'</td>
             <td><a href="'.base_url().'admin/message/view_inbox/'.$msg->id.'">'.$msg->subject.'</a></td>
             <td>'.$msg->date.'</td></tr>';
        }
    }
    ?>
    </tbody>
</table>
    <a class="btn" onclick="confirm_delete()" id="delete_btn">Delete</a>
</form>
<?php }?>
<script>
    function confirm_delete() {
    var id = id;
    var confirmModal = 
      $('<div class="modal hide fade">' +    
          '<div class="modal-header">' +
            '<a class="close" data-dismiss="modal" >&times;</a>' +
            '<h3>' + 'Delete Confirmation' +'</h3>' +
          '</div>' +

          '<div class="modal-body">' +
            '<p>' + 'Are you sure to delete??' + '</p>' +
          '</div>' +

          '<div class="modal-footer">' +
            '<a href="#" class="btn" data-dismiss="modal">' + 
              'Cancel' + 
            '</a>' +
            '<a href="#" id="okButton2" class="btn btn-primary">' + 
              'OK' + 
            '</a>' +
          '</div>' +
        '</div>');

    confirmModal.find('#okButton2').click(function(event) {
      confirmModal.modal('hide');
      $('#delete_submit').submit();
    });

    confirmModal.modal('show');     
  };
 function confirm_delete2(id) {
    var id = id;
    var confirmModal = 
      $('<div class="modal hide fade">' +    
          '<div class="modal-header">' +
            '<a class="close" data-dismiss="modal" >&times;</a>' +
            '<h3>' + 'Delete Confirmation' +'</h3>' +
          '</div>' +

          '<div class="modal-body">' +
            '<p>' + 'Are you sure to delete??' + '</p>' +
          '</div>' +

          '<div class="modal-footer">' +
            '<a href="#" class="btn" data-dismiss="modal">' + 
              'Cancel' + 
            '</a>' +
            '<a href="#" id="okButton2" class="btn btn-primary">' + 
              'OK' + 
            '</a>' +
          '</div>' +
        '</div>');

    confirmModal.find('#okButton2').click(function(event) {
      confirmModal.modal('hide');
      window.location.href = "<?php echo base_url();?>admin/message/delete_inbox/"+id;
    });

    confirmModal.modal('show');     
  };
</script>