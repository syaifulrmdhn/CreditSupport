<form class="form-horizontal" action="<?php echo base_url();?>admin/message/send_message" method="POST" >
     <div class="control-group">
            <label class="control-label">From</label>
            <div class="controls">
                <input type="text" name="receiver" value="<?php echo $msg_detail->from.','.$msg_detail->to;?>" readonly>
            </div>
        </div>    
        <div class="control-group">
            <label class="control-label">Subject</label>
            <div class="controls">
                <input type="text" name="subject" value="Re: <?php echo $msg_detail->subject?>">
            </div>
        </div>
        <div class="control-group">
        <label class="control-label">Body : </label>
        <div class="controls">
            <textarea class="textarea" id="some-text" name="some-text" style="width:500px; height:100px;" placeholder="Type your message here ...">
            <?php 
            echo '----------Pesan Original : -------------<br>';
            echo $msg_detail->body;?>
            </textarea>
        <br>
        <br>
        <button class="btn btn-primary">Send</button>
        <a class="btn" href="<?php echo base_url();?>admin/message">Cancel</a>
        </div>   
    </div>    
    </form>