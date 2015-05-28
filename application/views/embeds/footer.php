<?php
/**
 * Page footer embeded on all the app pages
 */
?>
<div id="logo">
    <img src="<?php echo base_url(); ?>assets/img/REMS-TA-Center.png" class="logo" />
    <p class="DOEcr">2015 &copy; United States Department of Education</p>
</div>
<?php if($this->session->userdata('loaded_school')): ?>
<div id="arrow_nav">
    <div id="left_arrow"><a href="#" id="leftArrowButton"><img src="<?php echo base_url(); ?>assets/img/arrow_left.png" id='leftArrowButton'/></a></div>
    <div id="right_arrow"><a href="#" id="rightArrowButton"><img src="<?php echo base_url(); ?>assets/img/arrow_right.png" id='rightArrowButton'/></a></div>
</div>
<?php endif; ?>