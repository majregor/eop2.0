<?php
/**
 * Main Menu Embedded into most pages for navigation
 */
?>
<div id="menu_row">
    <div id="menudiv">
        <ul>
            <li class="sb-toggle-left">MENU</li>
        </ul>

    </div>


    <div id="rightcontain">
        <div id="listdiv" style="padding-botton: 5px;">
            <ul class="ld">
                <?php if($this->session->userdata['role']['level']==3):  ?>
                <li>
                    <span id="subDistrictSelectionDiv">
                        <label for="slctsubdistrictselection"><a href="#">School:</a>  </label>
                                <select name="slctsubdistrictselection" id="slctsubdistrictselection" style="width:15%">
                                    <option value="" selected="selected">--Select--</option>
                                </select>
                              </span>
                </li>
                    <?php elseif($this->session->userdata['role']['level']>3):  ?>
                    <li>
                        <span><?php echo($this->session->userdata['loaded_school']['name']); ?></span>
                    </li>
                    <?php else: ?>

                <?php endif; ?>
                <li><a href="<?php echo base_url(); ?>home" >Home</a></li>
                <li><a href="<?php echo base_url(); ?>user/profile" >My Account</a></li>
                <li><a href="calendar">Calendar</a></li>
                <li><a href="plan">Planning Process</a></li>
                <li><a href="report" id="reportManagementLink">My EOP</a></li>
                <?php if($this->session->userdata['role']['level']<5):  ?>
                <li><a href="<?php echo base_url(); ?>user" id="userManagementLink">Users</a></li>
                <?php endif; ?>
                <li><a href="<?php echo base_url(); ?>login/signout" id="logoutLink">Log Out</a></li>
            </ul>
        </div>
    </div>
</div>