<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- **** Load JS and CSS Libraries ****** -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/modernizr.custom.15150.js" ></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/accordion.js" ></script>


        <link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/jquery-impromptu.css" rel="stylesheet" media="all" type="text/css"  />

        <!-- **** Load App specific JS and CSS ****** -->

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/slidebars.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tooltip.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/print.css" media="print" type="text/css" />
        <?php if(isset($page) && $page=='login'): ?>
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/front_cool.css" media="screen, projection" type="text/css"/>
            <script type="text/javascript" src='<?php echo base_url(); ?>assets/js/login.js'></script>
        <?php endif; ?>
        <script type="text/javascript" src='<?php echo base_url(); ?>assets/js/standard.js'></script>




        <title>EOP Assist <?php echo isset($page_title)?': '.$page_title :'';?></title>

        <script language="JavaScript" type="text/javascript">
            $(function(){
               $(document).tooltip({
                   track:false
               });
            });
        </script>
    </head>

    <body>
    <?php if(isset($page) && $page=='login') {

        echo( $contents );

    }
    else{ ?>
            <div id="sb-site">
                <div id="dtool" class="5dcontain">
                    <?php include('embeds/main_menu.php'); ?>
                    <?php include('embeds/sub_menu.php'); ?>
                    <div class="content" id='introOneContent'>
                        <?= $contents ?>
                    </div>
                </div>
                <div id="footer">
                    <?php include('embeds/footer.php'); ?>
                </div>
            </div>

        <?php include('embeds/sidebar.php'); ?>

            <!-- Import Final JS Scripts and CSS -->
            <script src="<?php echo base_url(); ?>assets/js/slidebars.js" type="text/javascript"></script>
            <script src="<?php echo base_url(); ?>assets/js/jquery-impromptu.js" type="text/javascript"></script>
        <?php }
?>
    </body>

</html>