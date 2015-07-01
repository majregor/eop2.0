<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DocStyles {

    var $titleStyles = array(
        array('size'=>16, 'color'=>'333333', 'bold'=>true, 'allCaps' => true),
        array('size'=>14, 'color'=>'666666', 'bold'=>true),
        array('size'=>12, 'color'=>'666666', 'bold'=>true),
        array('size'=>12, 'color'=>'666666'),
        array('size'=>8, 'color'=>'666666')
    );

    var  $fontStyles = array(
        'Goal'          =>  array('name'=>'Arial', 'size'=>12, 'color'=>'1B2232', 'bold' => true ),
        'Objective'     =>  array('name'=>'Arial', 'size'=>12, 'color'=>'1B2232','underline' => true),
        'Function'      =>  array('name'=>'Arial', 'size'=>12, 'color'=>'1B2232'),
        'COA'           =>  array('name'=>'Arial', 'size'=>12, 'color'=>'1B2232', 'bold' => true ),
        'Head_1'        =>  array('name'=>'Arial', 'size'=>18, 'allCaps' => true, 'bold' => true ),
        'docTitle'      =>  array('bold' => true, 'name' => 'Arial', 'size' => 26, 'allCaps' => false )
    );

    var  $paragraphStyles = array(
        'docTitleParagraph'=> array('align' => 'center', 'spaceAfter' => 300),
        'cover'=> array( 'size'=>12,'align' => 'center', 'spaceAfter' => 100)
    );

    var $linkStyles = array(
        'default'   =>  array('size'=>12, 'color'=>'blue')
    );


    var $tableStyles = array(
        'defaultTableStyle'   =>  array(
                                        array('borderSize'=>6, 'borderColor'=>'006699', 'cellMargin'=>80),
                                        array('borderBottomSize'=>18, 'borderBottomColor'=>'0000FF', 'bgColor'=>'66BBFF')
                                    )
    );

}