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

    var $school_id = null;

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
            $this->load->library('../controllers/school');

        }
        else{
            redirect('/login');
        }
    }

    public function test(){
        $source = "Text.docx";

        //echo date('H:i:s'), " Reading contents from `{$source}`";
        $phpword = \PhpOffice\PhpWord\IOFactory::load($source);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpword, 'HTML');

        $objWriter->save("php://output");

        /*$sections = $phpword->getSections();
        foreach($sections as $section){

            foreach ($section->getElements() as $key=>$element){
                if(get_class($element) === 'PhpOffice\PhpWord\Element\Text'){
                    echo("yes");
                }
                if(is_a($element, 'PhpOffice\PhpWord\Element\Text')){
                    print_r( $element->getFontStyle()); echo  "<br>";
                }
            }

        }*/
    }

    public function index(){

        $this->authenticate();

        $eligibleSchools = array();
        $schools_with_data = $this->report_model->getSchoolsWithData();

        if(isset($this->session->userdata['role']['level']) && $this->session->userdata['role']['level'] ==3){//District Admins
            $data = $this->school->get_schools_in_my_district();

            foreach($schools_with_data as $schoolWithData){
                foreach($data as $d){

                    if($schoolWithData[0]['id'] == $d['id']){
                        array_push($eligibleSchools, $schoolWithData);
                        break;
                    }
                }
            }
        }
        else if($this->session->userdata['role']['level'] ==4 || $this->session->userdata['role']['level'] ==5){ //School Admin and User
            foreach($schools_with_data as $schoolWithData){
                if($this->session->userdata['loaded_school']['id'] == $schoolWithData[0]['id']){
                    array_push($eligibleSchools, $schoolWithData);
                    break;
                }
            }
        }
        else if($this->session->userdata['role']['level'] ==1){ // Super Admins
            $eligibleSchools = $schools_with_data;
        }
        elseif($this->session->userdata['role']['level']==2){ // State Admins

        }


        $data = array(
            'schools_with_data' => $eligibleSchools
        );

        $templateData = array(
            'page'          =>  'myeop',
            'step_title'    =>  'MY EOP',
            'page_title'    =>  'My EOP',
            'page_vars'     =>  $data
        );
        $this->template->load('template', 'report_screen', $templateData);
    }

    public function make($school_id = ''){

        if($school_id==''){
            $this->school_id = isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : Null;
        }else{
            $this->school_id = $school_id;
        }

        $school = $this->school_model->getSchool($this->school_id);
        //Make file name from the school's name
        $fileName=$school[0]['name'];
        $fileName = preg_replace("([^\w\s\d\-_~,;:\[\]\(\).])",'', $fileName);
        $fileName = preg_replace("([\.]{2,})",'',$fileName);

        //Get plan data from database
        $form1Data      = $this->plan_model->getEntities('bp', array('name'=>'form1', 'sid'=>$this->school_id), true);
        $form2Data      = $this->plan_model->getEntities('bp', array('name'=>'form2', 'sid'=>$this->school_id), true);
        $form3Data      = $this->plan_model->getEntities('bp', array('name'=>'form3', 'sid'=>$this->school_id), true);
        $form4Data      = $this->plan_model->getEntities('bp', array('name'=>'form4', 'sid'=>$this->school_id), true);
        $form5Data      = $this->plan_model->getEntities('bp', array('name'=>'form5', 'sid'=>$this->school_id), true);
        $form6Data      = $this->plan_model->getEntities('bp', array('name'=>'form6', 'sid'=>$this->school_id), true);
        $form7Data      = $this->plan_model->getEntities('bp', array('name'=>'form7', 'sid'=>$this->school_id), true);
        $form8Data      = $this->plan_model->getEntities('bp', array('name'=>'form8', 'sid'=>$this->school_id), true);
        $form9Data      = $this->plan_model->getEntities('bp', array('name'=>'form9', 'sid'=>$this->school_id), true);
        $form10Data     = $this->plan_model->getEntities('bp', array('name'=>'form10', 'sid'=>$this->school_id), true);

        $fnData         = $this->plan_model->getEntities('fn', array('parent is not null'=>Null, 'sid'=>$this->school_id), true, array('orderby'=>'name', 'type'=>'ASC'));
        $topLevelFns    = $this->plan_model->getEntities('fn', array('parent'=>Null), false, array('orderby'=>'name', 'type'=>'ASC'));
        $functionalData = array();
        foreach($topLevelFns as $key=>$value){

            foreach($fnData as $v){
                if($value['name'] == $v['name']){
                    array_push($functionalData, $value);
                    break;
                }
            }
        }

        $THData  = $this->plan_model->getEntities('th',array('sid'=>$this->school_id), true);


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


        //Add Section 2
        $this->makeSection2($form2Data, $section);


        //Add Section 3
        $this->makeSection3($form3Data, $section);

        //Add Section 4
        $this->makeSection4($form4Data, $section);


        //Add Section 5
        $this->makeSection5($form5Data, $section);


        //Add Section 6
        $this->makeSection6($form6Data, $section);


        //Add Section 7
        $this->makeSection7($form7Data, $section);


        //Add Section 8
        $this->makeSection8($form8Data, $section);


        //Add Section 9
        $this->makeSection9($form9Data, $section);


        //Add Section 10
        $this->makeSection10($form10Data, $section);


        $this->makeFunctionalAnnexes($functionalData, $section);


        $this->makeTHAnnexes($THData, $section);


        $this->flushToBrowser($fileName);

    }

    function makeCoverPage($form1Data){
        if(is_array($form1Data) && count($form1Data)>0) {
            $html_dom = $this->simple_html_dom;
            $sectionCover = $this->word->addSection();

            //Add Document title (form 1.0 Title of the plan)
            $sectionCover->addTextBreak(5);
            $sectionCover->addText(htmlspecialchars(stripslashes($form1Data[0]['children'][0]['fields'][0]['body'])), 'docTitle', 'docTitleParagraph');
            $sectionCover->addTextBreak(5);

            //Add Date (form 1.0 Date)
            $sectionCover->addText(htmlspecialchars($form1Data[0]['children'][0]['fields'][1]['body']), null, 'cover');

            //Add the schools covered by the plan (form 1.0 Schools covered by the plan)
            $html_dom->load('<html><body>' . $form1Data[0]['children'][0]['fields'][2]['body'] . '</body></html>');
            // Create the dom array of elements which we are going to work on:
            $html_dom_array = $html_dom->find('html', 0)->children();
            // Convert the HTML and put it into the PHPWord object
            htmltodocx_insert_html($sectionCover, $html_dom_array[0]->nodes, $this->getStandardSettings('cover'));

            // Clear the HTML dom object:
            $html_dom->clear();

            $sectionCover->addTextBreak(10);
            $copyright1 = "This school EOP was prepared using the EOP ASSIST software application.";
            $copyright2 = "For more information, visit ";

            $sectionCover->addText($copyright1, null, 'cover');


            $textrun = $sectionCover->addTextRun('cover');
            $textrun->addText($copyright2);
            $textrun->addLink('http://rems.ed.gov/EOPASSIST', 'http://rems.ed.gov/EOPASSIST', 'default');
            $textrun->addText('.');


            $sectionCover->addPageBreak();
        }

    }

    function makeSection1($data, $section){

        if(is_array($data) && count($data)>0){

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

            //Add sub-section 1.4
            $section->addPageBreak();
            $section->addTitle('1.4 Record of Distribution', 3);
            $table = $section->addTable('defaultTableStyle');
            $cellStyle = array('valign'=>'center');
            $fontStyle = array('bold'=>true, 'align'=>'center');
            $table->addRow(900); // Add a row
            // Add cells
            $table->addCell(2000, $cellStyle)->addText('Title and name of person receiving the plan', $fontStyle);
            $table->addCell(2000, $cellStyle)->addText('Agency (school office, government agency, or private-sector entity', $fontStyle);
            $table->addCell(2000, $cellStyle)->addText('Date of delivery', $fontStyle);
            $table->addCell(2000, $cellStyle)->addText('Number of copies delivered', $fontStyle);

            $child4['fields'] = $data[0]['children'][4]['fields'];
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

            $section->addPageBreak(); //New Page

        }


    }

    function makeSection2($data, $section){
        if(is_array($data) && count($data)>0) {
            $html_dom = $this->simple_html_dom;
            $children = $data[0]['children'];

            $section->addTitle('2. Purpose, Scope, Situation Overview and Assumptions', 2);

            //Add sub-section 2.1
            $section->addTitle('2.1 Purpose', 3);
            $html_dom->load('<html><body>' . $children[0]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $this->getStandardSettings('default'));
            $html_dom->clear();

            //Add sub-section 2.2
            $section->addTitle('2.2 Scope', 3);
            $html_dom->load('<html><body>' . $children[1]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $this->getStandardSettings('default'));
            $html_dom->clear();

            //Add sub-section 2.3
            $section->addTitle('2.3 Situation Overview', 3);
            $html_dom->load('<html><body>' . $children[2]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $this->getStandardSettings('default'));
            $html_dom->clear();

            //Add sub-section 2.4
            $section->addTitle('2.4 Planning Assumptions', 3);
            $html_dom->load('<html><body>' . $children[3]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $this->getStandardSettings('default'));
            $html_dom->clear();

            $section->addPageBreak(); //New Page
        }
    }

    function makeSection3($data, $section){
        if(is_array($data) && count($data)>0) {
            $html_dom = $this->simple_html_dom;
            $children = $data[0]['children'];

            $section->addTitle('3. Concept of Operations (CONOPS)', 2);

            //Add sub-section 3.1
            $html_dom->load('<html><body>' . $children[0]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $this->getStandardSettings('default'));
            $html_dom->clear();

            $section->addPageBreak(); //New Page
        }

    }

    function makeSection4($data, $section){
        if(is_array($data) && count($data)>0) {
            $html_dom = $this->simple_html_dom;
            $children = $data[0]['children'];

            $section->addTitle('4. Organization and Assignment of Responsibilities', 2);

            //Add sub-section 4.1
            $html_dom->load('<html><body>' . $children[0]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $this->getStandardSettings('default'));
            $html_dom->clear();

            $section->addPageBreak(); //New Page
        }
    }

    function makeSection5($data, $section){
        if(is_array($data) && count($data)>0) {
            $html_dom = $this->simple_html_dom;
            $children = $data[0]['children'];

            $section->addTitle('5. Direction, Control, and Coordination', 2);

            //Add sub-section 5.1
            $html_dom->load('<html><body>' . $children[0]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $this->getStandardSettings('default'));
            $html_dom->clear();

            $section->addPageBreak(); // New Page
        }
    }

    function makeSection6($data, $section){
        if(is_array($data) && count($data)>0) {
            $html_dom = $this->simple_html_dom;
            $children = $data[0]['children'];

            $section->addTitle('6. Information Collection, Analysis, and Dissemination', 2);

            //Add sub-section 6.1
            $html_dom->load('<html><body>' . $children[0]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $this->getStandardSettings('default'));
            $html_dom->clear();

            $section->addPageBreak(); //New Page
        }
    }

    function makeSection7($data, $section){
        if(is_array($data) && count($data)>0) {
            $html_dom = $this->simple_html_dom;
            $children = $data[0]['children'];

            $section->addTitle('7. Training and Exercises', 2);

            //Add sub-section 7.1
            $html_dom->load('<html><body>' . $children[0]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $this->getStandardSettings('default'));
            $html_dom->clear();

            $section->addPageBreak(); //New Page
        }
    }

    function makeSection8($data, $section){
        if(is_array($data) && count($data)>0) {

            $html_dom = $this->simple_html_dom;
            $children = $data[0]['children'];

            $section->addTitle('8. Administration, Finance, and Logistics', 2);

            //Add sub-section 8.1
            $html_dom->load('<html><body>' . $children[0]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $this->getStandardSettings('default'));
            $html_dom->clear();

            $section->addPageBreak(); //New Page
        }
    }

    function makeSection9($data, $section){
        if(is_array($data) && count($data)>0) {

            $html_dom = $this->simple_html_dom;
            $children = $data[0]['children'];

            $section->addTitle('9. Plan Development and Maintenance', 2);

            //Add sub-section 9.1
            $html_dom->load('<html><body>' . $children[0]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $this->getStandardSettings('default'));
            $html_dom->clear();

            $section->addPageBreak(); //New Page
        }
    }

    function makeSection10($data, $section){
        if(is_array($data) && count($data)>0) {

            $html_dom = $this->simple_html_dom;
            $children = $data[0]['children'];

            $section->addTitle('10. Authorities and References', 2);

            //Add sub-section 10.1
            $html_dom->load('<html><body>' . $children[0]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $this->getStandardSettings('default'));
            $html_dom->clear();

            $section->addPageBreak(); //New Page
        }
    }

    function makeFunctionalAnnexes($data, $section){
        if(is_array($data) && count($data)>0) {

            $section->addTitle('Functional Annexes', 1);
            $html_dom = $this->simple_html_dom;
            $numItems= count($data);
            $i = 0;

            foreach ($data as $function) {

                $section->addTitle($function['name'], 2);

                if(isset($function['children']) && is_array($function['children'])) {
                    foreach ($function['children'] as $fnChild) {

                        if ($fnChild['type'] == 'g1' || $fnChild['type'] == 'g2' || $fnChild['type'] == 'g3') {
                            $textrun = $section->addTextRun('standardParagraph');
                            $textrun->addText(htmlspecialchars($fnChild['type_title'] . ':'), 'Goal');

                            foreach ($fnChild['fields'] as $field) {
                                $html_dom->load('<html><body>' . $field['body'] . '</body></html>');
                                $html_dom_array = $html_dom->find('html', 0)->children();
                                htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $this->getStandardSettings('default'));
                                $html_dom->clear();
                            }

                            foreach ($fnChild['children'] as $key => $grandChild) {
                                if ($grandChild['type'] == "obj") {
                                    $objTextRun = $section->addTextRun('objectiveParagraph');
                                    $objTextRun->addText('Objective: ', 'Objective');

                                    foreach ($grandChild['fields'] as $field) {
                                        $html_dom->load('<html><body>' . $field['body'] . '</body></html>');
                                        $html_dom_array = $html_dom->find('html', 0)->children();
                                        htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $this->getStandardSettings('default'));
                                        $html_dom->clear();
                                    }
                                }
                            }
                            foreach ($fnChild['children'] as $key => $grandChild) {
                                if ($grandChild['type'] == "ca") {
                                    $coaTextRun = $section->addTextRun('actionParagraph');
                                    $coaTextRun->addText('Courses of Action: ', 'COA');

                                    foreach ($grandChild['fields'] as $field) {
                                        $html_dom->load('<html><body>' . $field['body'] . '</body></html>');
                                        $html_dom_array = $html_dom->find('html', 0)->children();
                                        htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $this->getStandardSettings('default'));
                                        $html_dom->clear();
                                    }
                                }
                            }
                            $section->addTextRun('pOStyle')->addText(" ", array('size' => 8));
                        }
                    }
                }

                if(++$i === $numItems){ //Last item
                    //Do nothing
                }else{
                    $section->addPageBreak(); //New Page
                }

            }

        }

    }

    function makeTHAnnexes($data, $section){
        if(is_array($data) && count($data)>0) {
            $section->addTitle('Threat- and Hazard-Specific Annexes', 1);
            $html_dom = $this->simple_html_dom;
            $numItems= count($data);
            $i = 0;

            foreach ($data as $threat) {
                $section->addTitle($threat['name'], 2);

                if(isset($threat['children']) && is_array($threat['children'])) {
                    foreach ($threat['children'] as $thChild) {
                        if ($thChild['type'] == 'g1' || $thChild['type'] == 'g2' || $thChild['type'] == 'g3') {

                            $textrun = $section->addTextRun('standardParagraph');
                            $textrun->addText(htmlspecialchars($thChild['type_title'] . ':'), 'Goal');

                            foreach ($thChild['fields'] as $field) {
                                $html_dom->load('<html><body>' . $field['body'] . '</body></html>');
                                $html_dom_array = $html_dom->find('html', 0)->children();
                                htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $this->getStandardSettings('default'));
                                $html_dom->clear();
                            }

                            foreach ($thChild['children'] as $key => $grandChild) {
                                if ($grandChild['type'] == "obj") {
                                    $objTextRun = $section->addTextRun('objectiveParagraph');
                                    $objTextRun->addText('Objective: ', 'Objective');

                                    foreach ($grandChild['fields'] as $field) {
                                        $html_dom->load('<html><body>' . $field['body'] . '</body></html>');
                                        $html_dom_array = $html_dom->find('html', 0)->children();
                                        htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $this->getStandardSettings('default'));
                                        $html_dom->clear();
                                    }
                                }
                            }
                            foreach ($thChild['children'] as $key => $grandChild) {
                                if ($grandChild['type'] == "ca") {
                                    $coaTextRun = $section->addTextRun('actionParagraph');
                                    $coaTextRun->addText('Courses of Action: ', 'COA');

                                    foreach ($grandChild['fields'] as $field) {
                                        $html_dom->load('<html><body>' . $field['body'] . '</body></html>');
                                        $html_dom_array = $html_dom->find('html', 0)->children();
                                        htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $this->getStandardSettings('default'));
                                        $html_dom->clear();
                                    }
                                }
                            }
                            $section->addTextRun('pOStyle')->addText(" ", array('size' => 8));
                        }
                    }
                }

                if(++$i === $numItems){ //Last item
                    //Do nothing
                }else{
                    $section->addPageBreak(); //New Page
                }
            }
        }
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

    function flushToBrowser($fileName){

        $file = $fileName."_EOP.docx";
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($this->word, 'Word2007');


        // Redirect output to a client’s web browser (Word2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment;filename="'.$file.'"');
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