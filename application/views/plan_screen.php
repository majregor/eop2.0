<?php
$content_file_to_load = $page."_". $step . ".php";

if($this->session->userdata['role']['level']==3 ){
    if($this->session->userdata('loaded_school')){
        //Do nothing
    }else{
        ?>

        <div id="select_school_dialog" title="Select School">
            <p style="margin-top:20px;">
                <label>Schools:</label><br/>
                <select id="sltschool" name="sltschool"></select>
            </p>
        </div>
<?php
    }
}



include("content/".$content_file_to_load);