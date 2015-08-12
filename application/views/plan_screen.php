<?php
$content_file_to_load = $page."_". $step . ".php";

if($this->session->userdata['role']['level']<=3 ){
    if($this->session->userdata('loaded_school') && !empty($this->session->userdata['loaded_school']['id'])){
        //Do nothing
    }else{

        if($this->session->userdata['role']['level']!=2) {
            ?>

            <script>
                $(document).ready(function () {
                    $("a:not(.menuItem)").on('click', function () {
                        return false;
                    });
                });
            </script>

            <div id="select_school_dialog" title="Select School">
                <p style="margin-top:20px;">
                    <label>Schools:</label><br/>
                    <select id="sltschool" name="sltschool" required="required"></select>
                </p>
            </div>
        <?php
        }
        ?>
<?php
    }
}



include("content/".$content_file_to_load);