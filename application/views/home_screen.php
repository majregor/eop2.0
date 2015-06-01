<?php

if($this->session->userdata['role']['level']==3 && $this->session->userdata('loaded_school')){

    $content_file_to_load = "home_". $step . ".php";
    include("content/".$content_file_to_load);

}elseif($this->session->userdata['role']['level']==3){
    ?>
    <div class="col-half" style="text-align:center; margin-top:15%;">
        <h1 style="color:red">No school is selected. Please select a school.</h1>
    </div>

    <div id="select_school_dialog" title="Select School">
        <p style="margin-top:20px;">
            <label>Schools:</label><br/>
            <select id="sltschool" name="sltschool"></select>
        </p>
    </div>
<?php
}elseif($this->session->userdata['role']['level']<3){

    $content_file_to_load = "home_". $step . ".php";
    include("content/".$content_file_to_load);
}


?>
