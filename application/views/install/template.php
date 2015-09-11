<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--
             2015 © United States Department of Education

             The U.S. Department of Education contracted for final products and deliverables that were developed under the
             ED-ESE-12-O-0036 contract with Synergy Enterprises, Inc., and the contract stipulates that the U.S. Department of Education is the sole owner of EOP ASSIST.

             EOP ASSIST is being made available to the public pursuant to the following conditions.
             The U.S. Department of Education is making the software available to the public and grants the public the worldwide, non-exclusive, royalty-free right to
             use and distribute the software created pursuant to the ED-ESE-12-O-0036 contract, for only non-commercial and educational purposes.
             his license does not include the right to modify the code of the software tool or create derivative works therefrom.  If you have any questions regarding
             whether a proposed use is allowable under this license or want to request a particular use, please contact Madeline Sullivan at (202) 453-6705.

             THE U.S. DEPARTMENT OF EDUCATION IS PROVIDING THE SOFTWARE AS IT IS, AND MAKES NO REPRESENTATIONS OR WARRANTIES OF
             ANY KIND CONCERNING THE WORK—EXPRESS, IMPLIED, STATUTORY OR OTHERWISE, INCLUDING WITHOUT LIMITATION WARRANTIES OF
             TITLE, MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, NON-INFRINGEMENT, OR THE PRESENCE OR ABSENCE OF LATENT OR
             OTHER DEFECTS, ACCURACY, OR THE PRESENCE OR ABSENCE OF ERRORS, WHETHER OR NOT DISCOVERABLE, ALL TO THE GREATEST
             EXTENT PERMISSIBLE UNDER FEDERAL LAW.
         -->
        <title><?php echo($title); ?></title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/front_cool.css" media="screen, projection" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/cpstyle.css" type="text/css"/>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>

        <script language="JavaScript" type="text/javascript">

            $(document).ready(function(){

                $('#loading').hide();

            })
                .ajaxStart(function(){
                    $('#loading').show();
                })
                .ajaxStop(function(){
                    $('#loading').hide();
                });

        </script>

    </head>

    <body>
    <div id='loading'><img alt="loading" src="<?php echo base_url(); ?>assets/img/loading.gif"><span>Loading...</span></div>

    <div id="container">
            <h1 class="logotxt"><?php echo($title);?></h1>
            <fieldset id="signin_menu">


                <p class="logintxttop">The U.S. Department of Education contracted for final products and deliverables that were developed under the ED-ESE-12-O-0036 contract with Synergy Enterprises, Inc., and the contract stipulates that the U.S. Department of Education is the sole owner of EOP ASSIST.<br><br>For more information about EOP ASSIST, please contact the REMS TA Center at <a href="mailto:info@remstacenter.org" title="info@remstacenter.org">info@remstacenter.org</a> or on our toll-free telephone number, 1-855-781-REMS [7367]. Our hours of operation are Monday to Friday, 9:00 a.m. to 5:00 p.m., Eastern Time.
                </p>
                <?php echo( $contents ); ?>
           
              <div style="clear:both"></div>
                <p class="logintxtbtm">EOP ASSIST is being made available to the public pursuant to the following conditions.   The U.S. Department of Education is making the software available to the public and grants the public the worldwide, non-exclusive, royalty-free right to use and distribute the software created pursuant to the ED-ESE-12-O-0036 contract, for only non-commercial and educational purposes.  This license does not include the right to modify the code of the software tool or create derivative works therefrom.  If you have any questions regarding whether a proposed use is allowable under this license or want to request a particular use, please contact Madeline Sullivan at (202) 453-6705.<br><br>
                    THE U.S. DEPARTMENT OF EDUCATION IS PROVIDING THE SOFTWARE AS IT IS, AND MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND CONCERNING THE WORK—EXPRESS, IMPLIED, STATUTORY OR OTHERWISE, INCLUDING WITHOUT LIMITATION WARRANTIES OF TITLE, MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, NON-INFRINGEMENT, OR THE PRESENCE OR ABSENCE OF LATENT OR OTHER DEFECTS, ACCURACY, OR THE PRESENCE OR ABSENCE OF ERRORS, WHETHER OR NOT DISCOVERABLE, ALL TO THE GREATEST EXTENT PERMISSIBLE UNDER FEDERAL LAW.<br><br>


                    <a href="http://www.ed.gov/" target="_blank" title="Department of Education"><img class="DOEDlogo" src="<?php echo base_url(); ?>assets/img/DOElogo.png"></a>
                    <a href="http://rems.ed.gov/" target="_blank" title="Readiness and Emergency Management for Schools"><img class="REMSlogo" src="<?php echo base_url(); ?>assets/img/REMS-TA-Center.png"></a>
                </p>
                
            </fieldset>
            <p class="DOEcr">2015 &copy; United States Department of Education</p>
        </div>

    </body>

</html>