<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Report Controller Class
 *
 * Developed by Synergy Enterprises, Inc. for the U.S. Department of Education
 *
 * Report Responsible for:
 *
 * - Creating EOP Report for export
 *
 *
 * Date: 6/26/15 02:34 PM
 *
 * (c) 2015 United States Department of Education
 */

class Report extends CI_Controller{


    public function __construct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){
            //Load Libraries
            $this->load->library('simple_html_dom');
            $this->load->library('Html2Text');
            $this->load->library('word');
            $this->load->library('DocStyles');

            //Load helper functions
            $this->load->helper(array('h2d_htmlconverter', 'support_functions'));

            //Load Models
            $this->load->model('school_model');
            $this->load->model('plan_model');
            $this->load->model('report_model');
        }
        else{
            redirect('/login');
        }
    }

    public function index(){

        $this->authenticate();
        $this->makeReport();

        $data = array();

        $templateData = array(
            'page'          =>  'myeop',
            'step_title'    =>  'MY EOP',
            'page_title'    =>  'My EOP',
            'page_vars'     =>  $data
        );
        $this->template->load('template', 'report_screen', $templateData);
    }

    public function makeReport(){

        //Get plan data from database
        $form1Data = $this->plan_model->getEntities('bp', array('name'=>'form1'), true);

        $this->word->setDefaultFontSize(12);

        //Set the styles
        $styles = $this->docstyles;
        foreach($styles->fontStyles as $key=>$value){
            $this->word->addFontStyle($key, $value);
        }
        foreach($styles->paragraphStyles as $key=>$value){
            $this->word->addParagraphStyle($key, $value);
        }
        foreach($styles->titleStyles as $key=>$value){
            $this->word->addTitleStyle($key, $value);
        }
        foreach($styles->tableStyles as $key=>$value){
            $this->word->addTableStyle($key, $value[0], $value[1]);
        }
        foreach($styles->linkStyles as $key=>$value){
            $this->word->addLinkStyle($key, $value);
        }


        //Generate Cover Page
        $this->makeCoverPage($form1Data);

        $section = $this->word->addSection();

        $header = $section->createHeader();
        $header->addPreserveText(isset($form1Data[0]['children'][0]['fields'][0]['body']) ? htmlspecialchars(stripslashes($form1Data[0]['children'][0]['fields'][0]['body'])):"", null,array('align'=>'left'));
        $footer = $section->createFooter();
        $footer->addPreserveText('{PAGE}', null,array('align'=>'right'));

        //Add Table of Contents
        $section->addText('Table of Contents','Head_1','Head_1');
        $section->addTOC(array('spaceAfter'=>30, 'size'=>10), null, 1, 3);
        $section->addPageBreak();

        //Add Section 1
        $this->makeSection1($form1Data, $section);



        $this->flushToBrowser();


        //print_r($form1Data[0]['children'][0]['fields'][0]['body']);
        //@todo Integrate h2d_htmlconverter

    }

    function makeSection1($data, $section){

        $html_dom = $this->simple_html_dom;

        $section->addTitle('Basic Plan', 1);
        $section->addTitle('1. Introductory Material', 2);

        //Add sub-section 1.1
        $section->addTitle('1.1 Promulgation Document and Signatures', 3);
        $html_dom->load('<html><body>' . $data[0]['children'][1]['fields'][0]['body'] . '</body></html>');
        $html_dom_array = $html_dom->find('html',0)->children();
        htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $this->getStandardSettings('default'));
        $html_dom->clear();


        //Add sub-section 1.2
        $section->addPageBreak();
        $section->addTitle('1.2 Approval and Implementation', 3);
        $html_dom->load('<html><body>' . $data[0]['children'][2]['fields'][0]['body'] . '</body></html>');
        $html_dom_array = $html_dom->find('html',0)->children();
        htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $this->getStandardSettings('default'));
        $html_dom->clear();

        //Add sub-section 1.3
        $section->addPageBreak();
        $section->addTitle('1.3 Record of Changes', 3);
        $table = $section->addTable('defaultTableStyle');
        $cellStyle = array('valign'=>'center');
        $fontStyle = array('bold'=>true, 'align'=>'center');
        $table->addRow(900); // Add a row
        // Add cells
        $table->addCell(2000, $cellStyle)->addText('Change Number', $fontStyle);
        $table->addCell(2000, $cellStyle)->addText('Date of Change', $fontStyle);
        $table->addCell(2000, $cellStyle)->addText('Name', $fontStyle);
        $table->addCell(2000, $cellStyle)->addText('Summary of Change', $fontStyle);

        $child4['fields'] = $data[0]['children'][3]['fields'];
        $numFields = count($child4['fields']);
        for($i=1; $i<=($numFields/4); $i++){
            $table->addRow();
            foreach($child4['fields'] as $field_key=>$field){
                if($field['weight'] == $i){
                    $this->html2text->setHtml($field['body']);
                    $txt = $this->html2text->getText();
                    $table->addCell(2000)->addText(htmlspecialchars(stripslashes($txt)));

                }
            }

        }




    }
    function makeCoverPage($form1Data){

        $html_dom = $this->simple_html_dom;
        $sectionCover = $this->word->addSection();

        //Add Document title (form 1.0 Title of the plan)
        $sectionCover->addTextBreak(5);
        $sectionCover->addText(htmlspecialchars(stripslashes($form1Data[0]['children'][0]['fields'][0]['body'])), 'docTitle', 'docTitleParagraph');
        $sectionCover->addTextBreak(5);

        //Add Date (form 1.0 Date)
        $sectionCover->addText(htmlspecialchars($form1Data[0]['children'][0]['fields'][1]['body']),null, 'cover');

        //Add the schools covered by the plan (form 1.0 Schools covered by the plan)
        $html_dom->load('<html><body>' . $form1Data[0]['children'][0]['fields'][2]['body'] . '</body></html>');
        // Create the dom array of elements which we are going to work on:
        $html_dom_array = $html_dom->find('html',0)->children();
        // Convert the HTML and put it into the PHPWord object
        htmltodocx_insert_html($sectionCover, $html_dom_array[0]->nodes, $this->getStandardSettings('cover'));

        // Clear the HTML dom object:
        $html_dom->clear();

        $sectionCover->addTextBreak(10);
        $copyright1="This school EOP was prepared using the EOP ASSIST software application.";
        $copyright2="For more information, visit " ;

        $sectionCover->addText($copyright1,null, 'cover');



        $textrun = $sectionCover->addTextRun('cover');
        $textrun->addText($copyright2);
        $textrun->addLink('http://rems.ed.gov/EOPASSIST', 'http://rems.ed.gov/EOPASSIST', 'default');
        $textrun->addText('.');



        $sectionCover->addPageBreak();

    }


    /**
     * Function checks if user is logged in, redirects to login page if not.
     * @method authenticate
     * @return void
     */
    function authenticate(){
        if($this->session->userdata('is_logged_in')){
            //do nothing
        }
        else{
            redirect('/login');
        }
    }

    function getStandardSettings($state){

        $settings = null;
        $paths = htmltodocx_paths();

        switch($state){
            case 'default':

                $settings = array(
                    // Required parameters:
                    'phpword_object' => &$this->word, // Must be passed by reference.
                    // 'base_root' => 'http://test.local', // Required for link elements - change it to your domain.
                    // 'base_path' => '/htmltodocx/documentation/', // Path from base_root to whatever url your links are relative to.
                    'base_root' => $paths['base_root'],
                    'base_path' => $paths['base_path'],
                    // Optional parameters - showing the defaults if you don't set anything:
                    'current_style' => array('size' => '12'), // The PHPWord style on the top element - may be inherited by descendent elements.
                    'parents' => array(0 => 'body'), // Our parent is body.
                    'list_depth' => 0, // This is the current depth of any current list.
                    'context' => 'section', // Possible values - section, footer or header.
                    'pseudo_list' => TRUE, // NOTE: Word lists not yet supported (TRUE is the only option at present).
                    'pseudo_list_indicator_font_name' => 'Wingdings', // Bullet indicator font.
                    'pseudo_list_indicator_font_size' => '7', // Bullet indicator size.
                    'pseudo_list_indicator_character' => 'l ', // Gives a circle bullet point with wingdings.
                    'table_allowed' => TRUE, // Note, if you are adding this html into a PHPWord table you should set this to FALSE: tables cannot be nested in PHPWord.
                    'treat_div_as_paragraph' => TRUE, // If set to TRUE, each new div will trigger a new line in the Word document.

                    // Optional - no default:
                    'style_sheet' => htmltodocx_styles_example(), // This is an array (the "style sheet") - returned by htmltodocx_styles_example() here (in styles.inc) - see this function for an example of how to construct this array.
                );

                break;

            case 'cover':
                $settings = array(
                    // Required parameters:
                    'phpword_object' => &$this->word, // Must be passed by reference.
                    // 'base_root' => 'http://test.local', // Required for link elements - change it to your domain.
                    // 'base_path' => '/htmltodocx/documentation/', // Path from base_root to whatever url your links are relative to.
                    'base_root' => $paths['base_root'],
                    'base_path' => $paths['base_path'],
                    // Optional parameters - showing the defaults if you don't set anything:
                    'current_style' => array( 'size'=>'12','align' => 'center', 'spaceAfter' => '100'), // The PHPWord style on the top element - may be inherited by descendent elements.
                    'parents' => array(0 => 'body'), // Our parent is body.
                    'list_depth' => 0, // This is the current depth of any current list.
                    'context' => 'section', // Possible values - section, footer or header.
                    'pseudo_list' => TRUE, // NOTE: Word lists not yet supported (TRUE is the only option at present).
                    'pseudo_list_indicator_font_name' => 'Wingdings', // Bullet indicator font.
                    'pseudo_list_indicator_font_size' => '7', // Bullet indicator size.
                    'pseudo_list_indicator_character' => 'l ', // Gives a circle bullet point with wingdings.
                    'table_allowed' => TRUE, // Note, if you are adding this html into a PHPWord table you should set this to FALSE: tables cannot be nested in PHPWord.
                    'treat_div_as_paragraph' => TRUE, // If set to TRUE, each new div will trigger a new line in the Word document.

                    // Optional - no default:
                    'style_sheet' => htmltodocx_styles_example(), // This is an array (the "style sheet") - returned by htmltodocx_styles_example() here (in styles.inc) - see this function for an example of how to construct this array.
                );
                break;
        }

        return $settings;


    }

    function flushToBrowser(){

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($this->word, 'Word2007');


        // Redirect output to a client’s web browser (Word2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment;filename="reviewers-export.docx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter->save('php://output');
        exit;
    }
}