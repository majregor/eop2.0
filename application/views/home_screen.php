<?php

    if($this->session->userdata('selected_school')){ ?>

<?php
    }
    else{ // No school selected yet, so inform the user to select a school before they can continue
?>
        <div class="col-half" style="text-align:center; margin-top:15%;">
            <h1 style="color:red">No school is selected. Please select a school.</h1>
        </div>
<?php
    }
?>
