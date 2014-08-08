<?php 
echo 'paging : ';
echo $this->pagination->create_links();
?>
<form action="<?php echo base_url();?>admin/message/delete_outbox" method="POST">
<table class="table">
    <thead><th>&nbsp;</th><th>Sent To</th><th>Subject</th><th>Date</th></thead>
    <tbody>
    <?php 
    foreach($messages as $msg){
        echo '<tr><td><input type="checkbox" name="delete_msg[]" value="'.$msg->id.'"></td>
             <td>'.$msg->to.'</td>
             <td><a href="'.base_url().'admin/message/view_outbox/'.$msg->id.'">'.$msg->subject.'</a></td>
             <td>'.$msg->date.'</td></tr>';
    }
    ?>
    </tbody>
</table>
    <button class="btn" type="submit">Delete</button>
</form>