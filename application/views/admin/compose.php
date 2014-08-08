<style>
    form{
        position: relative;
        float: left;
        left: -80px;
    }
</style>
<form class="form-horizontal" action="<?php echo base_url();?>admin/message/send_message" method="POST">
    <div class="control-group">
        <label class="control-label">Send To : </label>
        <div class="controls">
<!--            <input type="text" name="receiver" data-provide="typehead" data-items="4" id="sendto" autocomplete="off">-->
            <input type="text" name="receiver" id="sendto" autocomplete="off">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Subject : </label>
        <div class="controls">
            <input type="text" name="subject">
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
<?php //echo $script;
?>
<script>
    $("#sendto").tokenInput("get_all_user",{
                theme: "facebook"
            });
</script>