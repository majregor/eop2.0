<?php
/**
 * Created by PhpStorm.
 * User: godfreymajwega
 * Date: 9/2/15
 * Time: 1:17 AM
 */
?>
<style>
    .content p{
        margin: 1em;
        width:95%;
        font-size: 12px;
        color: #444444;
    }
</style>
<?php
if((null != $this->session->flashdata('success'))):
    ?>
    <div id="errorDiv">
        <div class="notify notify-green">
            <span class="symbol icon-tick"></span>&nbsp;&nbsp;  <?php echo($this->session->flashdata('success'));?>
        </div>
    </div>

<?php endif; ?>

<?php
if((null != $this->session->flashdata('error'))):
    ?>
    <div id="errorDiv">
        <div class="notify notify-red">
            <span class="symbol icon-error"></span>&nbsp;&nbsp;  <?php echo($this->session->flashdata('error'));?>
        </div>
    </div>

<?php endif; ?>
<div class=" boxed-group" style="text-align:center; margin-top:20px;">
    <h3 id="pane-title">Data Migration Started</h3>
    <div class="boxed-group-inner clearfix" style="padding: 10px;">


        <p>Progress</p>

        <div style="border:1px solid #ccc; width:80%; height:20px; overflow:auto; background:#eee; display: block; margin: 10px auto;">
            <div id="progressor" style="background:#07c; width:0%; height:100%;"></div>
        </div>

        <div style="display:block;border:1px solid #000; padding:10px; width:80%; height:auto; overflow:auto; background:#eee; margin: 10px auto;" id="divProgress"></div>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        ajax_stream();
    });
    function doClear()
    {
        document.getElementById("divProgress").innerHTML = "";
    }

    function log_message(message)
    {
        document.getElementById("divProgress").innerHTML += message + '<br />';
    }

    function ajax_stream()
    {
        if (!window.XMLHttpRequest)
        {
            log_message("Your browser does not support the native XMLHttpRequest object.");
            return;
        }

        try
        {
            var xhr = new XMLHttpRequest();
            xhr.previous_text = '';

            //xhr.onload = function() { log_message("[XHR] Done. responseText: <i>" + xhr.responseText + "</i>"); };
            xhr.onerror = function() { log_message("[XHR] Fatal Error."); };
            xhr.onreadystatechange = function()
            {
                try
                {
                    if (xhr.readyState > 2)
                    {
                        var new_response = xhr.responseText.substring(xhr.previous_text.length);
                        var result = JSON.parse( new_response );
                        log_message(result.message);
                        //update the progressbar
                        document.getElementById('progressor').style.width = result.progress + "%";
                        xhr.previous_text = xhr.responseText;
                    }
                }
                catch (e)
                {
                    //log_message("<b>[XHR] Exception: " + e + "</b>");
                }


            };

            xhr.open("POST", "stream", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.setRequestHeader("Connection", "close");
            xhr.send("Making request...");
        }
        catch (e)
        {
            log_message("<b>[XHR] Exception: " + e + "</b>");
        }
    }

</script>


