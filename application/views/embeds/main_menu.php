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
                <li>
                    <span id="subDistrictSelectionDiv">
                                <select name="slctsubdistrictselection" id="slctsubdistrictselection" style="width:15%">
                                    <label>School: </label>
                                    <option value="" selected="selected">--Select--</option>
                                </select>
                              </span>
                </li>
                <li><a href="home" >Home</a></li>
                <li><a href="<?php echo base_url(); ?>user/profile" >My Account</a></li>
                <li><a href="calendar">Calendar</a></li>
                <li><a href="plan">Planning Process</a></li>
                <li><a href="report" id="reportManagementLink">My EOP</a></li>
                <?php if($this->session->userdata['role']['level']<5):  ?>
                <li><a href="user" id="userManagementLink">Users</a></li>
                <?php endif; ?>
                <li><a href="<?php echo base_url(); ?>login/signout" id="logoutLink">Log Out</a></li>
            </ul>
        </div>
    </div>
</div>