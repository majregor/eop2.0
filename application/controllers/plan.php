<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan extends CI_Controller{

    var $school_id = null;

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){
            $this->load->model('plan_model');
            $this->load->model('school_model');
            $this->school_id = isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : Null;

        }
        else{
            redirect('/login');
        }
    }

    public function index(){
        //Make sure user is logged in
        $this->authenticate();

        $this->step1();
    }

    public function setEOP(){
        $school_id = isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : Null;

        if($this->input->post('ajax')){
            if( !empty($school_id) ){
                $option = $this->input->post('option');

                $preferences = $this->school_model->getPreferences($school_id);
                if(is_array($preferences) && count($preferences)>0){
                    //update the preference value
                    $preferences['basic_plan_source'] = $option;
                    $this->school_model->updatePreferences($school_id, $preferences);
                }else{
                    //add the new value to preferences
                    $data = array('basic_plan_source'=>$option);
                    $this->school_model->updatePreferences($school_id, $data);
                }

                $data = array('success'=>true, 'option'=>$option);
                $this->output->set_output(json_encode($data));
            }else{
                $this->output->set_output("No school selected");
            }

        }
    }

    public function step1($step=1){

        $this->authenticate();

        $templateData = array(
            'page'          =>  'step1',
            'step'          =>  $step,
            'page_title'    =>  'step1',
            'step_title'    =>  'Planning Process'
        );
        $this->template->load('template', 'plan_screen', $templateData);
    }


    public function step2($step=1){

        $this->authenticate();

        $templateData = array(
            'page'          =>  'step2',
            'step'          =>  $step,
            'page_title'    =>  'step2',
            'step_title'    =>  'Planning Process'
        );
        $this->template->load('template', 'plan_screen', $templateData);
    }

    public function step3($step=1){

        $this->authenticate();

        $data = array();

        if($step==2){
            $thData = $this->plan_model->getEntities('th', array('sid'=>$this->school_id ));
            if(is_array($thData)){
                $data['entities'] = $thData;
            }
        }
        elseif($step==3){
            $thData = $this->plan_model->getEntities('th', array('sid'=>$this->school_id ), true);
            if(is_array($thData)){
                $data['entities'] = $thData;
            }
        }
        elseif($step==4){
            $fnData = $this->plan_model->getEntities('fn', array('parent is not null'=>Null, 'sid'=>$this->school_id), true, array('orderby'=>'name', 'type'=>'ASC'));
            $topLevelFns = $this->plan_model->getEntities('fn', array('parent'=>Null), false, array('orderby'=>'name', 'type'=>'ASC'));
            $cleanedFns= array();
            foreach($topLevelFns as $key=>$value){

                foreach($fnData as $v){
                    if($value['name'] == $v['name']){
                        array_push($cleanedFns, $v);
                        break;
                    }
                }
            }

            if(is_array($fnData)){
                $data['entities'] = $cleanedFns;
            }
        }

        $templateData = array(
            'page'          =>  'step3',
            'step'          =>  $step,
            'page_title'    =>  'step3',
            'step_title'    =>  'Planning Process',
            'page_vars'     =>  $data
        );
        $this->template->load('template', 'plan_screen', $templateData);
    }

    public function step4($step=1){
        $this->authenticate();

        $data = array();

        if($step==3){
            $thData = $this->plan_model->getEntities('th', array('sid'=>$this->school_id ),true);
            if(is_array($thData)){
                $data['entities'] = $thData;
            }
        }

        if($step==4){
            $fnData = $this->plan_model->getEntities('fn', array('parent is not null'=>Null, 'sid'=>$this->school_id), true, array('orderby'=>'name', 'type'=>'ASC'));
            $topLevelFns = $this->plan_model->getEntities('fn', array('parent'=>Null), false, array('orderby'=>'name', 'type'=>'ASC'));
            $cleanedFns= array();
            foreach($topLevelFns as $key=>$value){

                foreach($fnData as $v){
                    if($value['name'] == $v['name']){
                        array_push($cleanedFns, $v);
                        break;
                    }
                }
            }

            if(is_array($fnData)){
                $data['entities'] = $cleanedFns;
            }
        }

        $templateData = array(
            'page'          =>  'step4',
            'step'          =>  $step,
            'page_title'    =>  'step4',
            'step_title'    =>  'Planning Process',
            'page_vars'     =>  $data
        );
        $this->template->load('template', 'plan_screen', $templateData);
    }

    public function step5($step=1){

        $this->authenticate();

        $data = array();

        if($step==2){
            $thData = $this->plan_model->getEntities('th', array('sid'=>$this->school_id ), true);
            if(is_array($thData)){
                $data['entities'] = $thData;
                $data['showActions']=true;
            }
        }
        elseif($step==3) {
            $fnData = $this->plan_model->getEntities('fn', array('parent is not null' => Null, 'sid'=>$this->school_id), true, array('orderby' => 'name', 'type' => 'ASC'));
            $topLevelFns = $this->plan_model->getEntities('fn', array('parent' => Null), false, array('orderby' => 'name', 'type' => 'ASC'));
            $cleanedFns = array();
            foreach ($topLevelFns as $key => $value) {

                foreach ($fnData as $v) {
                    if ($value['name'] == $v['name']) {
                        array_push($cleanedFns, $v);
                        break;
                    }
                }
            }
            if(is_array($fnData)){
                $data['entities'] = $cleanedFns;
                $data['showActions']=true;
            }
        }
        elseif($step==4){

            $basicPlanEntities = $this->plan_model->getEntities('bp', array('sid'=>$this->school_id ), true, array('orderby'=>'weight', 'type'=>'ASC'));
            $data['entities'] = $basicPlanEntities;
            $preferences = $this->school_model->getPreferences($this->school_id);
            $data['EOP_type'] = $preferences['basic_plan_source'];

        }

        $templateData = array(
            'page'          =>  'step5',
            'step'          =>  $step,
            'page_title'    =>  'step5',
            'step_title'    =>  'Planning Process',
            'page_vars'     =>  $data
        );
        $this->template->load('template', 'plan_screen', $templateData);

    }

    public function step6($step=1){

        $this->authenticate();

        $data = array();


        $templateData = array(
            'page'          =>  'step6',
            'step'          =>  $step,
            'page_title'    =>  'step6',
            'step_title'    =>  'Planning Process',
            'page_vars'     =>  $data
        );
        $this->template->load('template', 'plan_screen', $templateData);

    }

    public function test(){
        //$thData = $this->plan_model->getEntities('th',null,true);
        $ff = $this->input->post('q4Rows');
        $data =array('dump' => $ff);
        $this->load->view('test', $data);
    }

    /**
     * Action to add new items
     *
     * @method add
     * @param string $param Optional Specifies nature of item to add default is entity
     * @param string $param2 Optional Specifies the type of the item or entity
     */
    public function add($param='entity', $param2=''){
        $this->authenticate();

        if($this->input->post('ajax')){
            $data = array(
                'name'      =>      $this->input->post('thname'),
                'title'     =>      $this->input->post('thname'),
                'owner'     =>      $this->session->userdata('user_id'),
                'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                'type_id'   =>      $this->plan_model->getEntityTypeId('th', 'name')
            );

            $savedRecs = $this->plan_model->addThreatAndHazard($data);

            if(is_numeric($savedRecs) && $savedRecs>=1){
                $this->output->set_output(json_encode(array(
                    'saved' =>  TRUE
                )));
            }
            else{
                $this->output->set_output(json_encode(array(
                    'saved' =>  FALSE
                )));
            }

        }else{ //Redirect to step2_2
            redirect('plan/step2/2');
        }
    }

    public function addFn(){
        $this->authenticate();

        if($this->input->post('ajax')){
            $fndata = array(
                'name'      =>      $this->input->post('txtfn'),
                'title'     =>      $this->input->post('txtfn'),
                'parent'    =>      null,
                'owner'     =>      $this->session->userdata('user_id'),
                'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                'type_id'   =>      $this->plan_model->getEntityTypeId('fn', 'name')
            );

            //Add top level function entity (without parent)
            $this->plan_model->addTHFn($fndata);

            $data = $this->plan_model->getEntities('fn', array('parent'=>null), false, array('orderby'=>'name', 'type'=>'ASC'));

            $this->output->set_output(json_encode($data));

        }
    }



    public function showTh(){
        if($this->input->post('ajax')){

            $thData =null;
            $param = $this->input->post('param');

            if($param=='all' || $param==''){
                $thData = $this->plan_model->getEntities('th', array('sid'=>$this->school_id ));
            }else{
                $p = array('id' =>$param, 'sid'=>$this->school_id);
                $thData = $this->plan_model->getEntities('th', $p);
            }

            $data= array(
                'thData' => $thData
            );

            $this->load->view('ajax/th', $data);


        }else{
            redirect('plan/step2/2');
        }
    }

    public function update($param='entity', $param2){

        if($param2=='th'){
            $id = $this->input->post('updateid');
            $data = array(
                'name'          =>  $this->input->post('updatetxtname')
            );

            $recs = $this->plan_model->update($id, $data);

            if(is_numeric($recs) && $recs>0){
                $this->session->set_flashdata('success','Record updated successfully!');
                redirect('plan/step2/2#errorDiv');
            }
            else{
                $this->session->set_flashdata('error','Update failed!');
                redirect('plan/step2/2#errorDiv');
            }
        }
    }

    public function loadTHCtls(){
        if($this->input->post('ajax')){
            $action = $this->input->post('action');
            $id     = $this->input->post('id');
            $showActions = ($this->input->post('showActions'))? $this->input->post('showActions'):false;

            switch($action){
                case 'add':
                    $fnData = $this->plan_model->getEntities('fn', array('parent'=>null), false, array('orderby'=>'name', 'type'=>'ASC')); // Get function Entities
                    $thData = $this->plan_model->getEntities('th', array('id'=>$id), true);
                    $data = array(
                        'entity_id'                 =>  $id,
                        'functions'                 =>  $fnData,
                        'threats_and_hazards'       =>  $thData,
                        'action'                    =>  'add'
                    );
                    if($showActions){
                        $data['showActions']=true;
                        $this->load->view('ajax/step5_th_goals', $data);
                    }else{
                        $data['showActions'] = false;
                        $this->load->view('ajax/step3_th_goals', $data);
                    }

                    break;
                case 'edit':
                case 'view':
                    $fnData = $this->plan_model->getEntities('fn', array('parent'=>null), false, array('orderby'=>'name', 'type'=>'ASC')); // Get function Entities
                    $thData = $this->plan_model->getEntities('th', array('id'=>$id), true);
                    $data = array(
                        'entity_id'                 =>  $id,
                        'functions'                 =>  $fnData,
                        'threats_and_hazards'       =>  $thData,
                        'action'                    =>  ($action=='edit') ? 'edit' : 'view'
                    );
                    if($showActions){
                        $data['showActions']=true;
                        $this->load->view('ajax/step5_th_goals', $data);
                    }
                    else{
                        $data['showActions']= false;
                        $this->load->view('ajax/step3_th_goals', $data);
                    }

                    break;

            }
        }else{
            redirect('plan/step3/3');
        }
    }

    public function loadFNCtls(){
        if($this->input->post('ajax')){
            $action = $this->input->post('action');
            $id     = $this->input->post('id');
            $showActions = ($this->input->post('showActions'))? $this->input->post('showActions'):false;

            switch($action){
                case 'add':
                    $fnData = $this->plan_model->getEntities('fn', array('parent is not null'=>Null, 'sid'=>$this->school_id), true, array('orderby'=>'name', 'type'=>'ASC'));
                    $topLevelFns = $this->plan_model->getEntities('fn', array('parent'=>Null), false, array('orderby'=>'name', 'type'=>'ASC'));
                    $cleanedFns= array();
                    foreach($topLevelFns as $key=>$value){

                        foreach($fnData as $v){
                            if($value['name'] == $v['name']){
                                array_push($cleanedFns, $v);
                                break;
                            }
                        }
                    }


                    $data = array(
                        'entity_id'                 =>  $id,
                        'functions'                 =>  $cleanedFns,
                        'action'                    =>  'add'
                    );

                    $this->load->view('ajax/step3_add_fn_goals', $data);
                    break;

                case 'edit':
                case 'view':
                    $fnData = $this->plan_model->getEntities('fn', array('id'=>$id), true);

                    $data = array(
                        'entity_id'                 =>  $id,
                        'functions'                 =>  $fnData,
                        'action'                    =>  ($action=='edit') ? 'edit' : 'view'
                    );
                    if($showActions){
                        $data['showActions']=true;
                        $this->load->view('ajax/step5_edit_fn_goals', $data);
                    }
                    else{
                        $data['showActions']=false;
                        $this->load->view('ajax/step3_edit_fn_goals', $data);
                    }

                    break;
            }
        }else{
            redirect('plan/step3/3');
        }
    }

    public function loadTHActionCtrls(){

        if($this->input->post('ajax')){
            $action = $this->input->post('action');
            $id     = $this->input->post('id');

            switch($action){
                case 'add':
                    $thData = $this->plan_model->getEntities('th', array('id'=>$id), true);
                    $data = array(
                        'entity_id'                 =>  $id,
                        'threats_and_hazards'       =>  $thData,
                        'action'                    =>  'add'
                    );

                    $this->load->view('ajax/step4_th_actions', $data);
                    break;
                case 'update':
                case 'view':
                    $thData = $this->plan_model->getEntities('th', array('id'=>$id), true);
                    $data = array(
                        'entity_id'                 =>  $id,
                        'threats_and_hazards'       =>  $thData,
                        'action'                    =>  ('update') ? 'update' : 'view'
                    );

                    $this->load->view('ajax/step4_th_actions', $data);
                    break;
            }
        }
    }

    public function loadFNActionCtrls(){
        if($this->input->post('ajax')){
            $action = $this->input->post('action');
            $id     = $this->input->post('id');

            switch($action){
                case 'add':
                    $fnData = $this->plan_model->getEntities('fn', array('id'=>$id), true);
                    $data = array(
                        'entity_id'                 =>  $id,
                        'functions'       =>  $fnData,
                        'action'                    =>  'add'
                    );

                    $this->load->view('ajax/step4_fn_actions', $data);
                    break;
                case 'update':
                case 'view':
                    $fnData = $this->plan_model->getEntities('fn', array('id'=>$id), true);
                    $data = array(
                        'entity_id'                 =>  $id,
                        'functions'       =>  $fnData,
                        'action'                    =>  ('update') ? 'update' : 'view'
                    );

                    $this->load->view('ajax/step4_fn_actions', $data);
                    break;
            }
        }
    }


    /**
     *
     */
    public function manageTHGoals(){
        if($this->input->post('ajax')){

            $action = $this->input->post('action');
            $mode = $this->input->post('mode');
            $id     = $this->input->post('id');
            $recs = null;

            switch($action){
                case 'save':
                    //Update the default goals and objectives

                    $g1Id       =   $this->input->post('g1Id');
                    $g2Id       =   $this->input->post('g2Id');
                    $g3Id       =   $this->input->post('g3Id');
                    $g1         =   $this->input->post('g1');
                    $g2         =   $this->input->post('g2');
                    $g3         =   $this->input->post('g3');
                    $g1FieldId  =   $this->input->post('g1FieldId');
                    $g2FieldId  =   $this->input->post('g2FieldId');
                    $g3FieldId  =   $this->input->post('g3FieldId');
                    $fn1Txt     =   $this->input->post('fn1Txt');
                    $fn2Txt     =   $this->input->post('fn2Txt');
                    $fn3Txt     =   $this->input->post('fn3Txt');
                    if($mode=='edit') {
                        $fn1Val = $this->input->post('fn1Val');
                        $fn2Val = $this->input->post('fn2Val');
                        $fn3Val = $this->input->post('fn3Val');
                    }
                    $g1ObjData  =   $this->input->post('g1ObjData');
                    $g2ObjData  =   $this->input->post('g2ObjData');
                    $g3ObjData  =   $this->input->post('g3ObjData');
                    $g1fnData   =   $this->input->post('g1fnData');
                    $g2fnData   =   $this->input->post('g2fnData');
                    $g3fnData   =   $this->input->post('g3fnData');
                    if($mode=='edit'){
                        $g1fnVal   =   $this->input->post('g1fnVal');
                        $g2fnVal   =   $this->input->post('g2fnVal');
                        $g3fnVal   =   $this->input->post('g3fnVal');
                    }
                    $g1ObjIds   =   $this->input->post('g1ObjIds');
                    $g2ObjIds   =   $this->input->post('g2ObjIds');
                    $g3ObjIds   =   $this->input->post('g3ObjIds');
                    $g1ObjFieldIds = $this->input->post('g1ObjFieldIds');
                    $g2ObjFieldIds = $this->input->post('g2ObjFieldIds');
                    $g3ObjFieldIds = $this->input->post('g3ObjFieldIds');
                    $g1ObjDataNew   =   ($this->input->post('g1ObjDataNew'))? $this->input->post('g1ObjDataNew'): array();
                    $g2ObjDataNew   =   ($this->input->post('g2ObjDataNew'))? $this->input->post('g2ObjDataNew'): array();
                    $g3ObjDataNew   =   ($this->input->post('g3ObjDataNew'))? $this->input->post('g3ObjDataNew'): array();
                    $g1fnDataNew    =   ($this->input->post('g1fnDataNew'))? $this->input->post('g1fnDataNew'): array();
                    $g2fnDataNew    =   ($this->input->post('g2fnDataNew'))? $this->input->post('g2fnDataNew'): array();
                    $g3fnDataNew    =   ($this->input->post('g3fnDataNew'))? $this->input->post('g3fnDataNew'): array();

                    if($this->input->post('coursesOfActions')){
                        $g1CAFieldId        =   $this->input->post('g1CAFieldId');
                        $g1CAData           =   $this->input->post('g1CAData');

                        $g2CAFieldId        =   $this->input->post('g2CAFieldId');
                        $g2CAData           =   $this->input->post('g2CAData');

                        $g3CAFieldId        =   $this->input->post('g3CAFieldId');
                        $g3CAData           =   $this->input->post('g3CAData');

                        $CAfieldsArray = array(
                            array('id'=>$g1CAFieldId, 'parent'=>$g1Id, 'data'=>$g1CAData),
                            array('id'=>$g2CAFieldId, 'parent'=>$g2Id, 'data'=>$g2CAData),
                            array('id'=>$g3CAFieldId, 'parent'=>$g3Id, 'data'=>$g3CAData)
                        );


                        //Edit courses of action
                        foreach($CAfieldsArray as $key=>$fieldObj){
                            if($this->plan_model->fieldExists($fieldObj['id'])){
                                $this->plan_model->updateField($fieldObj['id'], array('body'=>$fieldObj['data']));
                            }else{
                                //Create Course of action entity
                                $courseOfActionData = array(
                                    'name'      =>      'Goal '.($key+1).' Course of Action',
                                    'title'     =>      'Course of Action',
                                    'owner'     =>      $this->session->userdata('user_id'),
                                    'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                                    'type_id'   =>      $this->getEntityTypeId('ca', 'name'),
                                    'parent'    =>      $fieldObj['parent'],
                                    'weight'    =>      $key+1
                                );

                                $newCourseofActionId = $this->plan_model->addEntity($courseOfActionData);

                                $fieldData = array(
                                    'entity_id' =>      $newCourseofActionId,
                                    'name'      =>      'Goal '.$key.'TH Course of Action Field',
                                    'title'     =>      'Goal '.$key.'TH Course of Action Field',
                                    'weight'    =>      1,
                                    'type'      =>      'text',
                                    'body'      =>      $fieldObj['data']
                                );
                                $this->plan_model->addField($fieldData);
                            }
                        }

                    }


                    if($mode=='add') {
                        //Add field to TH to indicate that it has been initiated
                        $fieldData = array(
                            'entity_id' => $id,
                            'name' => 'TH Field',
                            'title' => 'Threats and Hazards Default Field',
                            'weight' => 1,
                            'type' => 'text',
                            'body' => ''
                        );

                        $recs = $this->plan_model->addField($fieldData);
                    }


                    // Update the default goal 1, 2 and 3 entities fields
                    $recs = $this->plan_model->updateField($g1FieldId, array('body'=>$g1));
                    $recs = $this->plan_model->updateField($g2FieldId, array('body'=>$g2));
                    $recs = $this->plan_model->updateField($g3FieldId, array('body'=>$g3));

                    //Save goal level functions
                    $fn1data = array(
                        'name'      =>      $fn1Txt,
                        'title'     =>      $fn1Txt,
                        'parent'    =>      $g1Id,
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('fn', 'name')
                    );
                    $fn2data = array(
                        'name'      =>      $fn2Txt,
                        'title'     =>      $fn2Txt,
                        'parent'    =>      $g2Id,
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('fn', 'name')
                    );
                    $fn3data = array(
                        'name'      =>      $fn3Txt,
                        'title'     =>      $fn3Txt,
                        'parent'    =>      $g3Id,
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('fn', 'name')
                    );

                    if($mode=='add') {
                        (trim(strtolower($fn1data['name'])) != "--select--") ? $recs = $this->plan_model->addTHFn($fn1data) : $recs = 0;
                        (trim(strtolower($fn2data['name'])) != "--select--") ? $recs = $this->plan_model->addTHFn($fn2data) : $recs = 0;
                        (trim(strtolower($fn3data['name'])) != "--select--") ? $recs = $this->plan_model->addTHFn($fn3data) : $recs = 0;
                    }else{
                        (trim(strtolower($fn1data['name'])) != "--select--") ? $recs = $this->plan_model->updateFn($g1Id, $fn1data) : $recs = 0;
                        (trim(strtolower($fn2data['name'])) != "--select--") ? $recs = $this->plan_model->updateFn($g2Id, $fn2data) : $recs = 0;
                        (trim(strtolower($fn3data['name'])) != "--select--") ? $recs = $this->plan_model->updateFn($g3Id, $fn3data) : $recs = 0;
                    }

                    foreach($g1ObjFieldIds as $key=>$value){
                        if($this->plan_model->fieldExists($value)){
                            $this->plan_model->updateField($value, array('body'=>$g1ObjData[$key]));

                            $fnData = array(
                                'name'      =>  $g1fnData[$key],
                                'title'     =>  $g1fnData[$key],
                                'parent'    =>  $g1ObjIds[$key],
                                'owner'     =>      $this->session->userdata('user_id'),
                                'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                                'type_id'   =>      $this->plan_model->getEntityTypeId('fn', 'name')
                            );
                            if($mode=='add') {
                                (trim(strtolower($fnData['name'])) != "--select--") ? $this->plan_model->addTHFn($fnData) : '';
                            }else{
                                (trim(strtolower($fnData['name'])) != "--select--") ? $this->plan_model->updateFn($g1ObjIds[$key], $fnData) : '';
                            }
                        }
                    }

                    foreach($g2ObjFieldIds as $key=>$value){
                        if($this->plan_model->fieldExists($value)){
                            $this->plan_model->updateField($value, array('body'=>$g2ObjData[$key]));

                            $fnData = array(
                                'name'      =>  $g2fnData[$key],
                                'title'     =>  $g2fnData[$key],
                                'parent'    =>  $g2ObjIds[$key],
                                'owner'     =>      $this->session->userdata('user_id'),
                                'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                                'type_id'   =>      $this->plan_model->getEntityTypeId('fn', 'name')
                            );
                            if($mode=='add'){
                                (trim(strtolower($fnData['name'])) != "--select--") ? $this->plan_model->addTHFn($fnData): '';
                            }else{
                                (trim(strtolower($fnData['name'])) != "--select--") ? $this->plan_model->updateFn($g2ObjIds[$key], $fnData): '';
                            }
                        }
                    }

                    foreach($g3ObjFieldIds as $key=>$value){
                        if($this->plan_model->fieldExists($value)){
                            $this->plan_model->updateField($value, array('body'=>$g3ObjData[$key]));

                            $fnData = array(
                                'name'      =>  $g3fnData[$key],
                                'title'     =>  $g3fnData[$key],
                                'parent'    =>  $g3ObjIds[$key],
                                'owner'     =>      $this->session->userdata('user_id'),
                                'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                                'type_id'   =>      $this->plan_model->getEntityTypeId('fn', 'name')
                            );
                            if($mode=='add'){
                                (trim(strtolower($fnData['name'])) != "--select--") ? $this->plan_model->addTHFn($fnData): '';
                            }else{
                                (trim(strtolower($fnData['name'])) != "--select--") ? $this->plan_model->updateFn($g3ObjIds[$key], $fnData): '';
                            }
                        }
                    }


                    // Add new Objectives and Functions if necessary
                    foreach($g1ObjDataNew as $key =>$value){
                        //Create new entity and field
                        $entityData = array(
                            'name'      =>      'Goal 1 Objective',
                            'title'     =>      'Objective',
                            'owner'     =>      $this->session->userdata('user_id'),
                            'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                            'type_id'   =>      $this->plan_model->getEntityTypeId('obj', 'name'),
                            'parent'    =>      $g1Id,
                            'weight'    =>      count($g1ObjData)+$key+1
                        );
                        $insertedEntityId = $this->plan_model->addEntity($entityData);

                        $fieldData = array(
                            'entity_id' =>      $insertedEntityId,
                            'name'      =>      'Objective Field',
                            'title'     =>      'Objective',
                            'weight'    =>      1,
                            'type'      =>      'text',
                            'body'      =>      $value
                        );
                        $this->plan_model->addField($fieldData);

                        $fnData = array(
                            'name'      =>      $g1fnDataNew[$key],
                            'title'     =>      $g1fnDataNew[$key],
                            'parent'    =>      $insertedEntityId,
                            'owner'     =>      $this->session->userdata('user_id'),
                            'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                            'type_id'   =>      $this->plan_model->getEntityTypeId('fn', 'name')
                        );
                        (trim(strtolower($fnData['name'])) != "--select--") ? $this->plan_model->addTHFn($fnData): '';
                    }

                    foreach($g2ObjDataNew as $key =>$value){
                        //Create new entity and field
                        $entityData = array(
                            'name'      =>      'Goal 2 Objective',
                            'title'     =>      'Objective',
                            'owner'     =>      $this->session->userdata('user_id'),
                            'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                            'type_id'   =>      $this->plan_model->getEntityTypeId('obj', 'name'),
                            'parent'    =>      $g2Id,
                            'weight'    =>      count($g2ObjData)+$key+1
                        );
                        $insertedEntityId = $this->plan_model->addEntity($entityData);

                        $fieldData = array(
                            'entity_id' =>      $insertedEntityId,
                            'name'      =>      'Goal 2 Objective Field',
                            'title'     =>      'Goal 2 Objective Field',
                            'weight'    =>      1,
                            'type'      =>      'text',
                            'body'      =>      $value
                        );
                        $this->plan_model->addField($fieldData);

                        $fnData = array(
                            'name'      =>      $g2fnDataNew[$key],
                            'title'     =>      $g2fnDataNew[$key],
                            'parent'    =>      $insertedEntityId,
                            'owner'     =>      $this->session->userdata('user_id'),
                            'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                            'type_id'   =>      $this->plan_model->getEntityTypeId('fn', 'name')
                        );
                        (trim(strtolower($fnData['name'])) != "--select--") ? $this->plan_model->addTHFn($fnData): '';
                    }

                    foreach($g3ObjDataNew as $key =>$value){
                        //Create new entity and field
                        $entityData = array(
                            'name'      =>      'Goal 3 Objective',
                            'title'     =>      'Objective',
                            'owner'     =>      $this->session->userdata('user_id'),
                            'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                            'type_id'   =>      $this->plan_model->getEntityTypeId('obj', 'name'),
                            'parent'    =>      $g3Id,
                            'weight'    =>      count($g3ObjData)+$key+1
                        );
                        $insertedEntityId = $this->plan_model->addEntity($entityData);

                        $fieldData = array(
                            'entity_id' =>      $insertedEntityId,
                            'name'      =>      'Goal 3 Objective Field',
                            'title'     =>      'Goal 3 Objective Field',
                            'weight'    =>      1,
                            'type'      =>      'text',
                            'body'      =>      $value
                        );
                        $this->plan_model->addField($fieldData);

                        $fnData = array(
                            'name'      =>      $g3fnDataNew[$key],
                            'title'     =>      $g3fnDataNew[$key],
                            'parent'    =>      $insertedEntityId,
                            'owner'     =>      $this->session->userdata('user_id'),
                            'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                            'type_id'   =>      $this->plan_model->getEntityTypeId('fn', 'name')
                        );
                        (trim(strtolower($fnData['name'])) != "--select--") ? $this->plan_model->addTHFn($fnData): '';
                    }

                    $this->session->set_flashdata('success', 'Data was saved Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));

                    break;
            }

        }else{
            redirect('plan/step3/3');
        }
    }

    public function manageFNGoals(){
        if($this->input->post('ajax')){

            $action = $this->input->post('action');
            $mode = $this->input->post('mode');
            $id     = $this->input->post('id');
            $recs = null;

            switch($action){
                case 'save':

                    $g1ObjData  =   $this->input->post('g1ObjData');
                    $g2ObjData  =   $this->input->post('g2ObjData');
                    $g3ObjData  =   $this->input->post('g3ObjData');
                    $g1         =   $this->input->post('g1');
                    $g2         =   $this->input->post('g2');
                    $g3         =   $this->input->post('g3');

                    //ADD Goal 1 Data
                    $goal1Data= array(
                        'name'      =>      'Goal 1',
                        'title'     =>      'Goal 1 (Before)',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('g1', 'name'),
                        'parent'    =>      $id,
                        'weight'    =>      1
                    );
                    $insertedGoalId = $this->plan_model->addEntity($goal1Data);

                    $goal1FieldData = array(
                        'entity_id' =>      $insertedGoalId,
                        'name'      =>      'Goal 1 Function Field',
                        'title'     =>      'Goal 1 Function Field',
                        'weight'    =>      1,
                        'type'      =>      'text',
                        'body'      =>      $g1
                    );
                    $this->plan_model->addField($goal1FieldData);

                    foreach($g1ObjData as $key =>$value){
                        //Create new entity and field
                        $entityData = array(
                            'name'      =>      'Goal 1 Objective',
                            'title'     =>      'Objective',
                            'owner'     =>      $this->session->userdata('user_id'),
                            'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                            'type_id'   =>      $this->plan_model->getEntityTypeId('obj', 'name'),
                            'parent'    =>      $insertedGoalId,
                            'weight'    =>      $key+1
                        );
                        $insertedEntityId = $this->plan_model->addEntity($entityData);

                        $fieldData = array(
                            'entity_id' =>      $insertedEntityId,
                            'name'      =>      'Goal 1 Objective Field',
                            'title'     =>      'Goal 1 Objective Field',
                            'weight'    =>      1,
                            'type'      =>      'text',
                            'body'      =>      $value
                        );
                        $this->plan_model->addField($fieldData);
                    }


                    // ADD Goal 2 Data
                    $goal2Data= array(
                        'name'      =>      'Goal 2',
                        'title'     =>      'Goal 2 (Before)',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('g2', 'name'),
                        'parent'    =>      $id,
                        'weight'    =>      1
                    );
                    $insertedGoalId = $this->plan_model->addEntity($goal2Data);

                    $goal2FieldData = array(
                        'entity_id' =>      $insertedGoalId,
                        'name'      =>      'Goal 2 Function Field',
                        'title'     =>      'Goal 2 Function Field',
                        'weight'    =>      1,
                        'type'      =>      'text',
                        'body'      =>      $g2
                    );
                    $this->plan_model->addField($goal2FieldData);

                    foreach($g2ObjData as $key =>$value){
                        //Create new entity and field
                        $entityData = array(
                            'name'      =>      'Goal 2 Objective',
                            'title'     =>      'Objective',
                            'owner'     =>      $this->session->userdata('user_id'),
                            'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                            'type_id'   =>      $this->plan_model->getEntityTypeId('obj', 'name'),
                            'parent'    =>      $insertedGoalId,
                            'weight'    =>      $key+1
                        );
                        $insertedEntityId = $this->plan_model->addEntity($entityData);

                        $fieldData = array(
                            'entity_id' =>      $insertedEntityId,
                            'name'      =>      'Goal 2 Objective Field',
                            'title'     =>      'Goal 2 Objective Field',
                            'weight'    =>      1,
                            'type'      =>      'text',
                            'body'      =>      $value
                        );
                        $this->plan_model->addField($fieldData);
                    }


                    // ADD Goal 3 Data
                    $goal3Data= array(
                        'name'      =>      'Goal 3',
                        'title'     =>      'Goal 3 (Before)',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('g3', 'name'),
                        'parent'    =>      $id,
                        'weight'    =>      1
                    );
                    $insertedGoalId = $this->plan_model->addEntity($goal3Data);

                    $goal3FieldData = array(
                        'entity_id' =>      $insertedGoalId,
                        'name'      =>      'Goal 3 Function Field',
                        'title'     =>      'Goal 3 Function Field',
                        'weight'    =>      1,
                        'type'      =>      'text',
                        'body'      =>      $g3
                    );
                    $this->plan_model->addField($goal3FieldData);

                    foreach($g3ObjData as $key =>$value){
                        //Create new entity and field
                        $entityData = array(
                            'name'      =>      'Goal 3 Objective',
                            'title'     =>      'Objective',
                            'owner'     =>      $this->session->userdata('user_id'),
                            'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                            'type_id'   =>      $this->plan_model->getEntityTypeId('obj', 'name'),
                            'parent'    =>      $insertedGoalId,
                            'weight'    =>      $key+1
                        );
                        $insertedEntityId = $this->plan_model->addEntity($entityData);

                        $fieldData = array(
                            'entity_id' =>      $insertedEntityId,
                            'name'      =>      'Goal 3 Objective Field',
                            'title'     =>      'Goal 3 Objective Field',
                            'weight'    =>      1,
                            'type'      =>      'text',
                            'body'      =>      $value
                        );
                        $this->plan_model->addField($fieldData);
                    }

                    $this->session->set_flashdata('success', 'Data was saved Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));

                    break;
                case 'update':

                    $g1Id       =   $this->input->post('g1Id');
                    $g2Id       =   $this->input->post('g2Id');
                    $g3Id       =   $this->input->post('g3Id');
                    $g1         =   $this->input->post('g1');
                    $g2         =   $this->input->post('g2');
                    $g3         =   $this->input->post('g3');
                    $g1FieldId  =   $this->input->post('g1FieldId');
                    $g2FieldId  =   $this->input->post('g2FieldId');
                    $g3FieldId  =   $this->input->post('g3FieldId');

                    $g1ObjIds   =   $this->input->post('g1ObjIds');
                    $g2ObjIds   =   $this->input->post('g2ObjIds');
                    $g3ObjIds   =   $this->input->post('g3ObjIds');
                    $g1ObjFieldIds = $this->input->post('g1ObjFieldIds');
                    $g2ObjFieldIds = $this->input->post('g2ObjFieldIds');
                    $g3ObjFieldIds = $this->input->post('g3ObjFieldIds');
                    $g1ObjData  =   $this->input->post('g1ObjData');
                    $g2ObjData  =   $this->input->post('g2ObjData');
                    $g3ObjData  =   $this->input->post('g3ObjData');

                    $g1ObjDataNew   =   ($this->input->post('g1ObjDataNew'))? $this->input->post('g1ObjDataNew'): array();
                    $g2ObjDataNew   =   ($this->input->post('g2ObjDataNew'))? $this->input->post('g2ObjDataNew'): array();
                    $g3ObjDataNew   =   ($this->input->post('g3ObjDataNew'))? $this->input->post('g3ObjDataNew'): array();

                    if($this->input->post('coursesOfActions')){
                        $g1CAFieldId        =   $this->input->post('g1CAFieldId');
                        $g1CAData           =   $this->input->post('g1CAData');

                        $g2CAFieldId        =   $this->input->post('g2CAFieldId');
                        $g2CAData           =   $this->input->post('g2CAData');

                        $g3CAFieldId        =   $this->input->post('g3CAFieldId');
                        $g3CAData           =   $this->input->post('g3CAData');

                        $CAfieldsArray = array(
                            array('id'=>$g1CAFieldId, 'parent'=>$g1Id, 'data'=>$g1CAData),
                            array('id'=>$g2CAFieldId, 'parent'=>$g2Id, 'data'=>$g2CAData),
                            array('id'=>$g3CAFieldId, 'parent'=>$g3Id, 'data'=>$g3CAData)
                        );

                        //Edit courses of action
                        foreach($CAfieldsArray as $key=>$fieldObj){
                            if($this->plan_model->fieldExists($fieldObj['id'])){
                                $this->plan_model->updateField($fieldObj['id'], array('body'=>$fieldObj['data']));
                            }else{
                                //Add Course of action entity
                                $courseOfActionData = array(
                                    'name'      =>      'Goal '.($key +1).' FN Course of Action',
                                    'title'     =>      'Course of Action',
                                    'owner'     =>      $this->session->userdata('user_id'),
                                    'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                                    'type_id'   =>      $this->getEntityTypeId('ca', 'name'),
                                    'parent'    =>      $fieldObj['parent'],
                                    'weight'    =>      $key+1
                                );

                                $newCourseofActionId = $this->plan_model->addEntity($courseOfActionData);

                                $fieldData = array(
                                    'entity_id' =>      $newCourseofActionId,
                                    'name'      =>      'Goal '.$key.'FN Course of Action Field',
                                    'title'     =>      'Goal '.$key.'FN Course of Action Field',
                                    'weight'    =>      1,
                                    'type'      =>      'text',
                                    'body'      =>      $fieldObj['data']
                                );
                                $this->plan_model->addField($fieldData);
                            }
                        }

                    }

                    //Update the goal data
                    $this->plan_model->updateField($g1FieldId, array('body'=>$g1));
                    $this->plan_model->updateField($g2FieldId, array('body'=>$g2));
                    $this->plan_model->updateField($g3FieldId, array('body'=>$g3));

                    //Update object data
                    foreach($g1ObjFieldIds as $key=>$value){
                        if($this->plan_model->fieldExists($value)){
                            $this->plan_model->updateField($value, array('body'=>$g1ObjData[$key]));
                        }
                    }

                    foreach($g2ObjFieldIds as $key=>$value){
                        if($this->plan_model->fieldExists($value)){
                            $this->plan_model->updateField($value, array('body'=>$g2ObjData[$key]));
                        }
                    }

                    foreach($g3ObjFieldIds as $key=>$value){
                        if($this->plan_model->fieldExists($value)){
                            $this->plan_model->updateField($value, array('body'=>$g3ObjData[$key]));
                        }
                    }

                    //Save any new data
                    foreach($g1ObjDataNew as $key =>$value){
                        //Create new entity and field
                        $entityData = array(
                            'name'      =>      'Goal 1 Objective',
                            'title'     =>      'Objective',
                            'owner'     =>      $this->session->userdata('user_id'),
                            'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                            'type_id'   =>      $this->plan_model->getEntityTypeId('obj', 'name'),
                            'parent'    =>      $g1Id,
                            'weight'    =>      count($g1ObjData)+$key+1
                        );
                        $insertedEntityId = $this->plan_model->addEntity($entityData);

                        $fieldData = array(
                            'entity_id' =>      $insertedEntityId,
                            'name'      =>      'Goal 1 Objective Field',
                            'title'     =>      'Goal 1 Objective Field',
                            'weight'    =>      1,
                            'type'      =>      'text',
                            'body'      =>      $value
                        );
                        $this->plan_model->addField($fieldData);

                    }

                    foreach($g2ObjDataNew as $key =>$value){
                        //Create new entity and field
                        $entityData = array(
                            'name'      =>      'Goal 2 Objective',
                            'title'     =>      'Objective',
                            'owner'     =>      $this->session->userdata('user_id'),
                            'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                            'type_id'   =>      $this->plan_model->getEntityTypeId('obj', 'name'),
                            'parent'    =>      $g2Id,
                            'weight'    =>      count($g2ObjData)+$key+1
                        );
                        $insertedEntityId = $this->plan_model->addEntity($entityData);

                        $fieldData = array(
                            'entity_id' =>      $insertedEntityId,
                            'name'      =>      'Goal 2 Objective Field',
                            'title'     =>      'Goal 2 Objective Field',
                            'weight'    =>      1,
                            'type'      =>      'text',
                            'body'      =>      $value
                        );
                        $this->plan_model->addField($fieldData);

                    }

                    foreach($g3ObjDataNew as $key =>$value){
                        //Create new entity and field
                        $entityData = array(
                            'name'      =>      'Goal 3 Objective',
                            'title'     =>      'Objective',
                            'owner'     =>      $this->session->userdata('user_id'),
                            'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                            'type_id'   =>      $this->plan_model->getEntityTypeId('obj', 'name'),
                            'parent'    =>      $g3Id,
                            'weight'    =>      count($g3ObjData)+$key+1
                        );
                        $insertedEntityId = $this->plan_model->addEntity($entityData);

                        $fieldData = array(
                            'entity_id' =>      $insertedEntityId,
                            'name'      =>      'Goal 3 Objective Field',
                            'title'     =>      'Goal 3 Objective Field',
                            'weight'    =>      1,
                            'type'      =>      'text',
                            'body'      =>      $value
                        );
                        $this->plan_model->addField($fieldData);

                    }

                    $this->session->set_flashdata('success', 'Data was updated Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));

                    break;



            }

        }else{
            redirect('plan/step3/4');
        }
    }


    public function manageTHActions(){
        if($this->input->post('ajax')){
                $THid           = $this->input->post('THid');

                $mode           = $this->input->post('mode');
                $g1Id           = $this->input->post('g1Id');
                $g1FieldId      = $this->input->post('g1FieldId');
                $g1CAData       = $this->input->post('g1CAData');
                $g2Id           = $this->input->post('g2Id');
                $g2FieldId      = $this->input->post('g2FieldId');
                $g2CAData       = $this->input->post('g2CAData');
                $g3Id           = $this->input->post('g3Id');
                $g3FieldId      = $this->input->post('g3FieldId');
                $g3CAData       = $this->input->post('g3CAData');

            $fieldsArray = array(
                array('id'=>$g1FieldId, 'parent'=>$g1Id, 'data'=>$g1CAData),
                array('id'=>$g2FieldId, 'parent'=>$g2Id, 'data'=>$g2CAData),
                array('id'=>$g3FieldId, 'parent'=>$g3Id, 'data'=>$g3CAData)
            );

            if($mode == 'add'){
                foreach($fieldsArray as $key=>$fieldObj){
                    if($this->plan_model->fieldExists($fieldObj['id'])){
                        $this->plan_model->updateField($fieldObj['id'], array('body'=>$fieldObj['data']));
                    }else{
                        $fieldData = array(
                            'entity_id' =>      $fieldObj['parent'],
                            'name'      =>      'Goal '.$key.'TH Course of Action Field',
                            'title'     =>      'Goal '.$key.'TH Course of Action Field',
                            'weight'    =>      1,
                            'type'      =>      'text',
                            'body'      =>      $fieldObj['data']
                        );
                        $this->plan_model->addField($fieldData);
                    }
                }

                $this->session->set_flashdata('success', 'Data was saved Successfully!');
                $this->output->set_output(json_encode(array(
                    'saved' =>  TRUE
                )));

            }else{
                foreach($fieldsArray as $key=>$fieldObj){
                    $this->plan_model->updateField($fieldObj['id'], array('body'=>$fieldObj['data']));
                }

                $this->session->set_flashdata('success', 'Data was saved Successfully!');
                $this->output->set_output(json_encode(array(
                    'saved' =>  TRUE
                )));
            }

        }else{
            redirect('plan/step4/3');
        }
    }


    public function manageFNActions(){
        if($this->input->post('ajax')){
            $FNid    = $this->input->post('FNid');

            $mode           = $this->input->post('mode');
            $g1Id           = $this->input->post('g1Id');
            $g1FieldId      = ($this->input->post('g1FieldId')) ?$this->input->post('g1FieldId') :0;
            $g1CAData       = $this->input->post('g1CAData');
            $g2Id           = $this->input->post('g2Id');
            $g2FieldId      = ($this->input->post('g2FieldId'))? $this->input->post('g2FieldId'):0;
            $g2CAData       = $this->input->post('g2CAData');
            $g3Id           = $this->input->post('g3Id');
            $g3FieldId      = ($this->input->post('g3FieldId')) ? $this->input->post('g3FieldId') :0;
            $g3CAData       = $this->input->post('g3CAData');

            $fieldsArray = array(
                array('id'=>$g1FieldId, 'parent'=>$g1Id, 'data'=>$g1CAData),
                array('id'=>$g2FieldId, 'parent'=>$g2Id, 'data'=>$g2CAData),
                array('id'=>$g3FieldId, 'parent'=>$g3Id, 'data'=>$g3CAData)
            );

            if($mode == 'add'){

                foreach($fieldsArray as $key=>$fieldObj){
                    if($this->plan_model->fieldExists($fieldObj['id'])){
                        $this->plan_model->updateField($fieldObj['id'], array('body'=>$fieldObj['data']));
                    }else{

                        //Insert new course of action entity first and field right after
                        $courseOfActionData = array(
                            'name'      =>      'Goal '.($key+1).' Course of Action',
                            'title'     =>      'Course of Action',
                            'owner'     =>      $this->session->userdata('user_id'),
                            'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                            'type_id'   =>      $this->plan_model->getEntityTypeId('ca', 'name'),
                            'parent'    =>      $fieldObj['parent'],
                            'weight'    =>      $key
                        );

                        $insertedCourseofAction_id = $this->plan_model->addEntity($courseOfActionData);

                        //Creating the field
                        $fieldData = array(
                            'entity_id' =>      $insertedCourseofAction_id,
                            'name'      =>      'Goal '.($key+1).'FN Course of Action Field',
                            'title'     =>      'Goal '.($key+1).'FN Course of Action Field',
                            'weight'    =>      1,
                            'type'      =>      'text',
                            'body'      =>      $fieldObj['data']
                        );
                        $this->plan_model->addField($fieldData);
                    }
                }

                $this->session->set_flashdata('success', 'Data was saved Successfully!');
                $this->output->set_output(json_encode(array(
                    'saved' =>  TRUE
                )));

            }else{
                foreach($fieldsArray as $key=>$fieldObj){
                    $this->plan_model->updateField($fieldObj['id'], array('body'=>$fieldObj['data']));
                }

                $this->session->set_flashdata('success', 'Data was saved Successfully!');
                $this->output->set_output(json_encode(array(
                    'saved' =>  TRUE
                )));
            }

        }else{
            redirect('plan/step4/4');
        }
    }

    public function loadForm1Ctls(){

        if($this->input->post('ajax')){
            $action = $this->input->post('action');

            switch($action){
                case 'add':
                    $data= array(
                        'action'=>  'add'
                    );
                    $this->load->view('ajax/form1', $data);
                    break;

                case 'edit':
                case 'view':
                    $entityId = $this->input->post('entityId');
                    $bpData = $this->plan_model->getEntities('bp', array('id'=>$entityId), true);

                    $data = array(
                        'action'        =>  ($action=='edit') ? 'edit' : 'view',
                        'entities'      =>  $bpData,
                        'entityId'      =>  $entityId
                    );
                    $this->load->view('ajax/form1', $data);

                    break;
            }
        }else{
            redirect('plan/step5/4');
        }

    }

    public function loadForm2Ctls(){

        if($this->input->post('ajax')){
            $action = $this->input->post('action');

            switch($action){
                case 'add':
                    $data= array(
                        'action'=>  'add'
                    );
                    $this->load->view('ajax/form2', $data);
                    break;

                case 'edit':
                case 'view':
                    $entityId = $this->input->post('entityId');
                    $bpData = $this->plan_model->getEntities('bp', array('id'=>$entityId), true);

                    $data = array(
                        'action'        =>  ($action=='edit') ? 'edit' : 'view',
                        'entities'      =>  $bpData,
                        'entityId'      =>  $entityId
                    );
                    $this->load->view('ajax/form2', $data);

                    break;
            }
        }else{
            redirect('plan/step5/4');
        }

    }

    public function loadForm3Ctls(){

        if($this->input->post('ajax')){
            $action = $this->input->post('action');

            switch($action){
                case 'add':
                    $data= array(
                        'action'=>  'add'
                    );
                    $this->load->view('ajax/form3', $data);
                    break;

                case 'edit':
                case 'view':
                    $entityId = $this->input->post('entityId');
                    $bpData = $this->plan_model->getEntities('bp', array('id'=>$entityId), true);

                    $data = array(
                        'action'        =>  ($action=='edit') ? 'edit' : 'view',
                        'entities'      =>  $bpData,
                        'entityId'      =>  $entityId
                    );
                    $this->load->view('ajax/form3', $data);

                    break;
            }
        }else{
            redirect('plan/step5/4');
        }

    }

    public function loadForm4Ctls(){

        if($this->input->post('ajax')){
            $action = $this->input->post('action');

            switch($action){
                case 'add':
                    $data= array(
                        'action'=>  'add'
                    );
                    $this->load->view('ajax/form4', $data);
                    break;

                case 'edit':
                case 'view':
                    $entityId = $this->input->post('entityId');
                    $bpData = $this->plan_model->getEntities('bp', array('id'=>$entityId), true);

                    $data = array(
                        'action'        =>  ($action=='edit') ? 'edit' : 'view',
                        'entities'      =>  $bpData,
                        'entityId'      =>  $entityId
                    );
                    $this->load->view('ajax/form4', $data);

                    break;
            }
        }else{
            redirect('plan/step5/4');
        }

    }

    public function loadForm5Ctls(){

        if($this->input->post('ajax')){
            $action = $this->input->post('action');

            switch($action){
                case 'add':
                    $data= array(
                        'action'=>  'add'
                    );
                    $this->load->view('ajax/form5', $data);
                    break;

                case 'edit':
                case 'view':
                    $entityId = $this->input->post('entityId');
                    $bpData = $this->plan_model->getEntities('bp', array('id'=>$entityId), true);

                    $data = array(
                        'action'        =>  ($action=='edit') ? 'edit' : 'view',
                        'entities'      =>  $bpData,
                        'entityId'      =>  $entityId
                    );
                    $this->load->view('ajax/form5', $data);

                    break;
            }
        }else{
            redirect('plan/step5/4');
        }

    }

    public function loadForm6Ctls(){

        if($this->input->post('ajax')){
            $action = $this->input->post('action');

            switch($action){
                case 'add':
                    $data= array(
                        'action'=>  'add'
                    );
                    $this->load->view('ajax/form6', $data);
                    break;

                case 'edit':
                case 'view':
                    $entityId = $this->input->post('entityId');
                    $bpData = $this->plan_model->getEntities('bp', array('id'=>$entityId), true);

                    $data = array(
                        'action'        =>  ($action=='edit') ? 'edit' : 'view',
                        'entities'      =>  $bpData,
                        'entityId'      =>  $entityId
                    );
                    $this->load->view('ajax/form6', $data);

                    break;
            }
        }else{
            redirect('plan/step5/4');
        }

    }

    public function loadForm7Ctls(){

        if($this->input->post('ajax')){
            $action = $this->input->post('action');

            switch($action){
                case 'add':
                    $data= array(
                        'action'=>  'add'
                    );
                    $this->load->view('ajax/form7', $data);
                    break;

                case 'edit':
                case 'view':
                    $entityId = $this->input->post('entityId');
                    $bpData = $this->plan_model->getEntities('bp', array('id'=>$entityId), true);

                    $data = array(
                        'action'        =>  ($action=='edit') ? 'edit' : 'view',
                        'entities'      =>  $bpData,
                        'entityId'      =>  $entityId
                    );
                    $this->load->view('ajax/form7', $data);

                    break;
            }
        }else{
            redirect('plan/step5/4');
        }

    }

    public function loadForm8Ctls(){

        if($this->input->post('ajax')){
            $action = $this->input->post('action');

            switch($action){
                case 'add':
                    $data= array(
                        'action'=>  'add'
                    );
                    $this->load->view('ajax/form8', $data);
                    break;

                case 'edit':
                case 'view':
                    $entityId = $this->input->post('entityId');
                    $bpData = $this->plan_model->getEntities('bp', array('id'=>$entityId), true);

                    $data = array(
                        'action'        =>  ($action=='edit') ? 'edit' : 'view',
                        'entities'      =>  $bpData,
                        'entityId'      =>  $entityId
                    );
                    $this->load->view('ajax/form8', $data);

                    break;
            }
        }else{
            redirect('plan/step5/4');
        }

    }

    public function loadForm9Ctls(){

        if($this->input->post('ajax')){
            $action = $this->input->post('action');

            switch($action){
                case 'add':
                    $data= array(
                        'action'=>  'add'
                    );
                    $this->load->view('ajax/form9', $data);
                    break;

                case 'edit':
                case 'view':
                    $entityId = $this->input->post('entityId');
                    $bpData = $this->plan_model->getEntities('bp', array('id'=>$entityId), true);

                    $data = array(
                        'action'        =>  ($action=='edit') ? 'edit' : 'view',
                        'entities'      =>  $bpData,
                        'entityId'      =>  $entityId
                    );
                    $this->load->view('ajax/form9', $data);

                    break;
            }
        }else{
            redirect('plan/step5/4');
        }

    }

    public function loadForm10Ctls(){

        if($this->input->post('ajax')){
            $action = $this->input->post('action');

            switch($action){
                case 'add':
                    $data= array(
                        'action'=>  'add'
                    );
                    $this->load->view('ajax/form10', $data);
                    break;

                case 'edit':
                case 'view':
                    $entityId = $this->input->post('entityId');
                    $bpData = $this->plan_model->getEntities('bp', array('id'=>$entityId), true);

                    $data = array(
                        'action'        =>  ($action=='edit') ? 'edit' : 'view',
                        'entities'      =>  $bpData,
                        'entityId'      =>  $entityId
                    );
                    $this->load->view('ajax/form10', $data);

                    break;
            }
        } else{
            redirect('plan/step5/4');
        }

    }

    public function manageForm1(){
        if($this->input->post('ajax')){

            $action             = $this->input->post('action');
            $q3Rows             = $this->input->post('q3Rows');
            $q4Rows             = $this->input->post('q4Rows');
            $titleField         = $this->input->post('titleField');
            $dateField          = $this->input->post('dateField');
            $schoolsField       = $this->input->post('schoolsField');
            $promulgationField  = $this->input->post('promulgationField');
            $approvalField      = $this->input->post('approvalField');



            switch($action){

                case 'add':
                    //Add form1 entity
                    $entityData = array(
                        'name'      =>      'form1',
                        'title'     =>      'Introductory Material',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'weight'    =>      1
                    );

                    $insertedEntityId = $this->plan_model->addEntity($entityData);

                    /**
                     * Add Children and their corresponding fields
                     */
                    //1.0
                    $entityData = array(
                        'name'      =>      '1.0',
                        'title'     =>      'Cover Page',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'parent'    =>      $insertedEntityId,
                        'weight'    =>      1
                    );
                    $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                    //1.0 fields
                            $fieldData = array(
                                'entity_id' =>      $insertedChildEntityId,
                                'name'      =>      'Title Field',
                                'title'     =>      'Title of the plan',
                                'weight'    =>      1,
                                'type'      =>      'text',
                                'body'      =>      $titleField
                            );
                            $this->plan_model->addField($fieldData);

                            $fieldData = array(
                                'entity_id' =>      $insertedChildEntityId,
                                'name'      =>      'Date Field',
                                'title'     =>      'Date',
                                'weight'    =>      2,
                                'type'      =>      'text',
                                'body'      =>      $dateField
                            );
                            $this->plan_model->addField($fieldData);

                            $fieldData = array(
                                'entity_id' =>      $insertedChildEntityId,
                                'name'      =>      'School Field',
                                'title'     =>      'The school(s) covered by the plan',
                                'weight'    =>      3,
                                'type'      =>      'text',
                                'body'      =>      $schoolsField
                            );
                            $this->plan_model->addField($fieldData);
                    //1.1
                    $entityData = array(
                        'name'      =>      '1.1',
                        'title'     =>      'Promulgation Document and Signatures',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'parent'    =>      $insertedEntityId,
                        'weight'    =>      2
                    );
                    $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                    //1.1 fields
                            $fieldData = array(
                                'entity_id' =>      $insertedChildEntityId,
                                'name'      =>      'Promulgation Field',
                                'title'     =>      'Promulgation Field',
                                'weight'    =>      1,
                                'type'      =>      'text',
                                'body'      =>      $promulgationField
                            );
                            $this->plan_model->addField($fieldData);
                    //1.2
                    $entityData = array(
                        'name'      =>      '1.2',
                        'title'     =>      'Approval and Implementation',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'parent'    =>      $insertedEntityId,
                        'weight'    =>      3
                    );
                    $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                    //1.2 fields
                    $fieldData = array(
                        'entity_id' =>      $insertedChildEntityId,
                        'name'      =>      'Approval Field',
                        'title'     =>      'Approval Field',
                        'weight'    =>      1,
                        'type'      =>      'text',
                        'body'      =>      $approvalField
                    );
                    $this->plan_model->addField($fieldData);

                    //1.3
                    $entityData = array(
                        'name'      =>      '1.3',
                        'title'     =>      'Record of Changes',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'parent'    =>      $insertedEntityId,
                        'weight'    =>      3
                    );
                    $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                    //1.3 fields
                            $columns = array('Change Number', 'Date of Change', 'Name', 'Summary of Change');
                            foreach($q3Rows as $row_key=>$row){
                                foreach($row as $key=>$value ){
                                    $fieldData = array(
                                        'entity_id' =>      $insertedChildEntityId,
                                        'name'      =>      $columns[$key],
                                        'title'     =>      $columns[$key],
                                        'weight'    =>      ($row_key+1),
                                        'type'      =>      'text',
                                        'body'      =>      $value
                                    );
                                    $this->plan_model->addField($fieldData);
                                }

                            }

                    //1.4
                    $entityData = array(
                        'name'      =>      '1.4',
                        'title'     =>      'Record of Distribution',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'parent'    =>      $insertedEntityId,
                        'weight'    =>      4
                    );
                    $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                    //1.4 fields
                            $columns = array(
                                'Title and name of person receiving the plan',
                                'Agency (school office, government agency, or private-sector entity',
                                'Date of delivery',
                                'Number of copies delivered'
                            );

                            foreach($q4Rows as $row_key=>$row){
                                foreach($row as $key=>$value ){
                                    $fieldData = array(
                                        'entity_id' =>      $insertedChildEntityId,
                                        'name'      =>      $columns[$key],
                                        'title'     =>      $columns[$key],
                                        'weight'    =>      ($row_key+1),
                                        'type'      =>      'text',
                                        'body'      =>      $value
                                    );
                                    $this->plan_model->addField($fieldData);
                                }
                            }

                    $this->session->set_flashdata('success', 'Data was saved Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));

                    break;

                case 'edit':

                    $entityId             = $this->input->post('entityId');
                    $q3EntityId           = $this->input->post('q3EntityId');
                    $q4EntityId           = $this->input->post('q4EntityId');
                    $titleFieldId         = $this->input->post('titleFieldId');
                    $dateFieldId          = $this->input->post('dateFieldId');
                    $schoolsFieldId       = $this->input->post('schoolsFieldId');
                    $promulgationFieldId  = $this->input->post('promulgationFieldId');
                    $approvalFieldId      = $this->input->post('approvalFieldId');

                    $this->plan_model->updateField($titleFieldId, array('body'=>$titleField));
                    $this->plan_model->updateField($dateFieldId, array('body'=>$dateField));
                    $this->plan_model->updateField($schoolsFieldId, array('body'=>$schoolsField));
                    $this->plan_model->updateField($promulgationFieldId, array('body'=>$promulgationField));
                    $this->plan_model->updateField($approvalFieldId, array('body'=>$approvalField));

                    //Delete fields table before adding new 1.3 and 1.4 fields
                    $this->plan_model->deleteFields(array('entity_id'=>$q3EntityId));
                    $this->plan_model->deleteFields(array('entity_id'=>$q4EntityId));

                    //Add new 1.3 fields
                    $columns = array('Change Number', 'Date of Change', 'Name', 'Summary of Change');
                    foreach($q3Rows as $row_key=>$row){
                        foreach($row as $key=>$value ){
                            $fieldData = array(
                                'entity_id' =>      $q3EntityId,
                                'name'      =>      $columns[$key],
                                'title'     =>      $columns[$key],
                                'weight'    =>      ($row_key+1),
                                'type'      =>      'text',
                                'body'      =>      $value
                            );
                            $this->plan_model->addField($fieldData);
                        }
                    }



                    //Add new 1.4 fields
                    $columns = array(
                        'Title and name of person receiving the plan',
                        'Agency (school office, government agency, or private-sector entity',
                        'Date of delivery',
                        'Number of copies delivered'
                    );
                    foreach($q4Rows as $row_key=>$row){
                        foreach($row as $key=>$value ){
                            $fieldData = array(
                                'entity_id' =>      $q4EntityId,
                                'name'      =>      $columns[$key],
                                'title'     =>      $columns[$key],
                                'weight'    =>      ($row_key+1),
                                'type'      =>      'text',
                                'body'      =>      $value
                            );
                            $this->plan_model->addField($fieldData);
                        }
                    }

                    $this->session->set_flashdata('success', 'Data was updated Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));
                    break;
            }
        }else{
            redirect('plan/step5/4');
        }
    }

    public function manageForm2(){
        if($this->input->post('ajax')){

            $action                 = $this->input->post('action');
            $purposeField           = $this->input->post('purposeField');
            $scopeField             = $this->input->post('scopeField');
            $situationField         = $this->input->post('situationField');
            $assumptionsField       = $this->input->post('assumptionsField');



            switch($action){

                case 'add':
                    //Add form2 entity
                    $entityData = array(
                        'name'      =>      'form2',
                        'title'     =>      'Purpose, Scope, Situation Overview, and Assumptions',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'weight'    =>      1
                    );

                    $insertedEntityId = $this->plan_model->addEntity($entityData);

                    /**
                     * Add Children and their corresponding fields
                     */
                    //2.1
                    $entityData = array(
                        'name'      =>      '2.1',
                        'title'     =>      'Purpose',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'parent'    =>      $insertedEntityId,
                        'weight'    =>      1
                    );
                    $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                    //2.1 fields
                    $fieldData = array(
                        'entity_id' =>      $insertedChildEntityId,
                        'name'      =>      'Purpose Field',
                        'title'     =>      'Purpose',
                        'weight'    =>      1,
                        'type'      =>      'text',
                        'body'      =>      $purposeField
                    );
                    $this->plan_model->addField($fieldData);


                    //2.2
                    $entityData = array(
                        'name'      =>      '2.2',
                        'title'     =>      'Scope',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'parent'    =>      $insertedEntityId,
                        'weight'    =>      2
                    );
                    $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                    //2.2 fields
                    $fieldData = array(
                        'entity_id' =>      $insertedChildEntityId,
                        'name'      =>      'Scope',
                        'title'     =>      'Scope',
                        'weight'    =>      1,
                        'type'      =>      'text',
                        'body'      =>      $scopeField
                    );
                    $this->plan_model->addField($fieldData);

                    //2.3
                    $entityData = array(
                        'name'      =>      '2.3',
                        'title'     =>      'Situation Overview',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'parent'    =>      $insertedEntityId,
                        'weight'    =>      3
                    );
                    $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                    //2.3 fields
                    $fieldData = array(
                        'entity_id' =>      $insertedChildEntityId,
                        'name'      =>      'Situation Overview',
                        'title'     =>      'Situation Overview',
                        'weight'    =>      1,
                        'type'      =>      'text',
                        'body'      =>      $situationField
                    );
                    $this->plan_model->addField($fieldData);

                    //2.4
                    $entityData = array(
                        'name'      =>      '2.4',
                        'title'     =>      'Planning Assumptions',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'parent'    =>      $insertedEntityId,
                        'weight'    =>      3
                    );
                    $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                    //2.4 fields
                    $fieldData = array(
                        'entity_id' =>      $insertedChildEntityId,
                        'name'      =>      'Planning Assumptions',
                        'title'     =>      'Planning Assumptions',
                        'weight'    =>      1,
                        'type'      =>      'text',
                        'body'      =>      $assumptionsField
                    );
                    $this->plan_model->addField($fieldData);


                    $this->session->set_flashdata('success', 'Data was saved Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));

                    break;

                case 'edit':

                    $entityId               = $this->input->post('entityId');
                    $purposeFieldId         = $this->input->post('purposeFieldId');
                    $scopeFieldId           = $this->input->post('scopeFieldId');
                    $situationFieldId       = $this->input->post('situationFieldId');
                    $assumptionsFieldId     = $this->input->post('assumptionsFieldId');

                    $this->plan_model->updateField($purposeFieldId, array('body'=>$purposeField));
                    $this->plan_model->updateField($scopeFieldId, array('body'=>$scopeField));
                    $this->plan_model->updateField($situationFieldId, array('body'=>$situationField));
                    $this->plan_model->updateField($assumptionsFieldId, array('body'=>$assumptionsField));

                    $this->session->set_flashdata('success', 'Data was Updated Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));
                    break;
            }
        }else{
            redirect('plan/step5/4');
        }
    }

    public function manageForm3(){
        if($this->input->post('ajax')){

            $action                 = $this->input->post('action');
            $conceptField           = $this->input->post('conceptField');


            switch($action){

                case 'add':
                    //Add form3 entity
                    $entityData = array(
                        'name'      =>      'form3',
                        'title'     =>      'Concept of Operations (CONOPS)',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'weight'    =>      1
                    );

                    $insertedEntityId = $this->plan_model->addEntity($entityData);

                    /**
                     * Add Children and their corresponding fields
                     */
                    //3.1
                    $entityData = array(
                        'name'      =>      '3.1',
                        'title'     =>      'CONOPS',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'parent'    =>      $insertedEntityId,
                        'weight'    =>      1
                    );
                    $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                    //3.1 fields
                    $fieldData = array(
                        'entity_id' =>      $insertedChildEntityId,
                        'name'      =>      'CONOPS Field',
                        'title'     =>      'CONOPS',
                        'weight'    =>      1,
                        'type'      =>      'text',
                        'body'      =>      $conceptField
                    );
                    $this->plan_model->addField($fieldData);

                    $this->session->set_flashdata('success', 'Data was saved Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));

                    break;

                case 'edit':

                    $entityId               = $this->input->post('entityId');
                    $conceptFieldId         = $this->input->post('conceptFieldId');


                    $this->plan_model->updateField($conceptFieldId, array('body'=>$conceptField));


                    $this->session->set_flashdata('success', 'Data was updated Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));
                    break;
            }
        }else{
            redirect('plan/step5/4');
        }
    }

    public function manageForm4(){
        if($this->input->post('ajax')){

            $action                 = $this->input->post('action');
            $orgField           = $this->input->post('orgField');


            switch($action){

                case 'add':
                    //Add form4 entity
                    $entityData = array(
                        'name'      =>      'form4',
                        'title'     =>      'Organization and Assignment of Responsibilities',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'weight'    =>      1
                    );

                    $insertedEntityId = $this->plan_model->addEntity($entityData);

                    /**
                     * Add Children and their corresponding fields
                     */
                    //4.1
                    $entityData = array(
                        'name'      =>      '4.1',
                        'title'     =>      'Organization and Assignment of Responsibilities',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'parent'    =>      $insertedEntityId,
                        'weight'    =>      1
                    );
                    $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                    //4.1 fields
                    $fieldData = array(
                        'entity_id' =>      $insertedChildEntityId,
                        'name'      =>      'Organization Field',
                        'title'     =>      'Organization and Assignment of Responsibilities',
                        'weight'    =>      1,
                        'type'      =>      'text',
                        'body'      =>      $orgField
                    );
                    $this->plan_model->addField($fieldData);

                    $this->session->set_flashdata('success', 'Data was saved Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));

                    break;

                case 'edit':

                    $entityId               = $this->input->post('entityId');
                    $orgFieldId         = $this->input->post('orgFieldId');


                    $this->plan_model->updateField($orgFieldId, array('body'=>$orgField));


                    $this->session->set_flashdata('success', 'Data was updated Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));
                    break;
            }
        }else{
            redirect('plan/step5/4');
        }
    }

    public function manageForm5(){
        if($this->input->post('ajax')){

            $action                 = $this->input->post('action');
            $directionField           = $this->input->post('directionField');


            switch($action){

                case 'add':
                    //Add form5 entity
                    $entityData = array(
                        'name'      =>      'form5',
                        'title'     =>      'Direction, Control and Coordination',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'weight'    =>      1
                    );

                    $insertedEntityId = $this->plan_model->addEntity($entityData);

                    /**
                     * Add Children and their corresponding fields
                     */
                    //5.1
                    $entityData = array(
                        'name'      =>      '5.1',
                        'title'     =>      'Direction, Control and Coordination',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'parent'    =>      $insertedEntityId,
                        'weight'    =>      1
                    );
                    $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                    //5.1 fields
                    $fieldData = array(
                        'entity_id' =>      $insertedChildEntityId,
                        'name'      =>      'Direction Field',
                        'title'     =>      'Direction, Control and Coordination',
                        'weight'    =>      1,
                        'type'      =>      'text',
                        'body'      =>      $directionField
                    );
                    $this->plan_model->addField($fieldData);

                    $this->session->set_flashdata('success', 'Data was saved Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));

                    break;

                case 'edit':

                    $entityId               = $this->input->post('entityId');
                    $directionFieldId         = $this->input->post('directionFieldId');


                    $this->plan_model->updateField($directionFieldId, array('body'=>$directionField));

                    $this->session->set_flashdata('success', 'Data was updated Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));
                    break;
            }
        }else{
            redirect('plan/step5/4');
        }
    }

    public function manageForm6(){
        if($this->input->post('ajax')){

            $action                 = $this->input->post('action');
            $infoField           = $this->input->post('infoField');


            switch($action){

                case 'add':
                    //Add form6 entity
                    $entityData = array(
                        'name'      =>      'form6',
                        'title'     =>      'Information Collection, Analysis and Dissemination',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'weight'    =>      1
                    );

                    $insertedEntityId = $this->plan_model->addEntity($entityData);

                    /**
                     * Add Children and their corresponding fields
                     */
                    //6.1
                    $entityData = array(
                        'name'      =>      '6.1',
                        'title'     =>      'Information Collection, Analysis and Dissemination',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'parent'    =>      $insertedEntityId,
                        'weight'    =>      1
                    );
                    $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                    //6.1 fields
                    $fieldData = array(
                        'entity_id' =>      $insertedChildEntityId,
                        'name'      =>      'Information Field',
                        'title'     =>      'Information Collection, Analysis and Dissemination',
                        'weight'    =>      1,
                        'type'      =>      'text',
                        'body'      =>      $infoField
                    );
                    $this->plan_model->addField($fieldData);

                    $this->session->set_flashdata('success', 'Data was saved Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));

                    break;

                case 'edit':

                    $entityId               = $this->input->post('entityId');
                    $infoFieldId         = $this->input->post('infoFieldId');


                    $this->plan_model->updateField($infoFieldId, array('body'=>$infoField));

                    $this->session->set_flashdata('success', 'Data was updated Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));
                    break;
            }
        }else{
            redirect('plan/step5/4');
        }
    }

    public function manageForm7(){
        if($this->input->post('ajax')){

            $action                 = $this->input->post('action');
            $trainingField           = $this->input->post('trainingField');


            switch($action){

                case 'add':
                    //Add form7 entity
                    $entityData = array(
                        'name'      =>      'form7',
                        'title'     =>      'Training Exercise',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'weight'    =>      1
                    );

                    $insertedEntityId = $this->plan_model->addEntity($entityData);

                    /**
                     * Add Children and their corresponding fields
                     */
                    //7.1
                    $entityData = array(
                        'name'      =>      '7.1',
                        'title'     =>      'Training Exercise',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'parent'    =>      $insertedEntityId,
                        'weight'    =>      1
                    );
                    $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                    //7.1 fields
                    $fieldData = array(
                        'entity_id' =>      $insertedChildEntityId,
                        'name'      =>      'Training Exercise Field',
                        'title'     =>      'Training Exercise',
                        'weight'    =>      1,
                        'type'      =>      'text',
                        'body'      =>      $trainingField
                    );
                    $this->plan_model->addField($fieldData);

                    $this->session->set_flashdata('success', 'Data was saved Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));

                    break;

                case 'edit':

                    $entityId               = $this->input->post('entityId');
                    $trainingFieldId         = $this->input->post('trainingFieldId');


                    $this->plan_model->updateField($trainingFieldId, array('body'=>$trainingField));

                    $this->session->set_flashdata('success', 'Data was updated Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));
                    break;
            }
        }else{
            redirect('plan/step5/4');
        }
    }

    public function manageForm8(){
        if($this->input->post('ajax')){

            $action                 = $this->input->post('action');
            $adminField           = $this->input->post('adminField');


            switch($action){

                case 'add':
                    //Add form8 entity
                    $entityData = array(
                        'name'      =>      'form8',
                        'title'     =>      'Administration, Finance, and Logistics',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'weight'    =>      1
                    );

                    $insertedEntityId = $this->plan_model->addEntity($entityData);

                    /**
                     * Add Children and their corresponding fields
                     */
                    //8.1
                    $entityData = array(
                        'name'      =>      '8.1',
                        'title'     =>      'Administration, Finance, and Logistics',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'parent'    =>      $insertedEntityId,
                        'weight'    =>      1
                    );
                    $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                    //8.1 fields
                    $fieldData = array(
                        'entity_id' =>      $insertedChildEntityId,
                        'name'      =>      'Administration, Finance, and Logistics Field',
                        'title'     =>      'Administration, Finance, and Logistics',
                        'weight'    =>      1,
                        'type'      =>      'text',
                        'body'      =>      $adminField
                    );
                    $this->plan_model->addField($fieldData);

                    $this->session->set_flashdata('success', 'Data was saved Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));

                    break;

                case 'edit':

                    $entityId               = $this->input->post('entityId');
                    $adminFieldId         = $this->input->post('adminFieldId');


                    $this->plan_model->updateField($adminFieldId, array('body'=>$adminField));

                    $this->session->set_flashdata('success', 'Data was updated Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));
                    break;
            }
        }else{
            redirect('plan/step5/4');
        }
    }

    public function manageForm9(){
        if($this->input->post('ajax')){

            $action                 = $this->input->post('action');
            $planField           = $this->input->post('planField');


            switch($action){

                case 'add':
                    //Add form9 entity
                    $entityData = array(
                        'name'      =>      'form9',
                        'title'     =>      'Plan Development and Maintenance',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'weight'    =>      1
                    );

                    $insertedEntityId = $this->plan_model->addEntity($entityData);

                    /**
                     * Add Children and their corresponding fields
                     */
                    //9.1
                    $entityData = array(
                        'name'      =>      '9.1',
                        'title'     =>      'Plan Development and Maintenance',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'parent'    =>      $insertedEntityId,
                        'weight'    =>      1
                    );
                    $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                    //9.1 fields
                    $fieldData = array(
                        'entity_id' =>      $insertedChildEntityId,
                        'name'      =>      'Plan Development and Maintenance Field',
                        'title'     =>      'Plan Development and Maintenance',
                        'weight'    =>      1,
                        'type'      =>      'text',
                        'body'      =>      $planField
                    );
                    $this->plan_model->addField($fieldData);

                    $this->session->set_flashdata('success', 'Data was saved Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));

                    break;

                case 'edit':

                    $entityId               = $this->input->post('entityId');
                    $planFieldId         = $this->input->post('planFieldId');


                    $this->plan_model->updateField($planFieldId, array('body'=>$planField));


                    $this->session->set_flashdata('success', 'Data was updated Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));
                    break;
            }
        }else{
            redirect('plan/step5/4');
        }
    }

    public function manageForm10(){
        if($this->input->post('ajax')){

            $action                 = $this->input->post('action');
            $authField           = $this->input->post('authField');


            switch($action){

                case 'add':
                    //Add form10 entity
                    $entityData = array(
                        'name'      =>      'form10',
                        'title'     =>      'Authorities and References',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'weight'    =>      1
                    );

                    $insertedEntityId = $this->plan_model->addEntity($entityData);

                    /**
                     * Add Children and their corresponding fields
                     */
                    //10.1
                    $entityData = array(
                        'name'      =>      '10.1',
                        'title'     =>      'Authorities and References',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'parent'    =>      $insertedEntityId,
                        'weight'    =>      1
                    );
                    $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                    //10.1 fields
                    $fieldData = array(
                        'entity_id' =>      $insertedChildEntityId,
                        'name'      =>      'Authorities and References Field',
                        'title'     =>      'Authorities and References',
                        'weight'    =>      1,
                        'type'      =>      'text',
                        'body'      =>      $authField
                    );
                    $this->plan_model->addField($fieldData);

                    $this->session->set_flashdata('success', 'Data was saved Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));

                    break;

                case 'edit':

                    $entityId               = $this->input->post('entityId');
                    $authFieldId         = $this->input->post('authFieldId');


                    $this->plan_model->updateField($authFieldId, array('body'=>$authField));

                    $this->session->set_flashdata('success', 'Data was updated Successfully!');
                    $this->output->set_output(json_encode(array(
                        'saved' =>  TRUE
                    )));
                    break;
            }
        }else{
            redirect('plan/step5/4');
        }
    }

    public function removeObjective(){
        if($this->input->post('ajax')){
            $entityId = $this->input->post('entityId');
            $this->plan_model->removeObjective($entityId);

            $this->output->set_output('deleted');
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

    public function setSelectedTHs(){
        $thData = $this->plan_model->getEntities('th', array('sid'=>$this->school_id ));

        if($this->input->post('ajax') && $this->input->post('THids')){
            $THids = $this->input->post('THids');

            foreach($thData as $THentity){
                if(in_array($THentity['id'], $THids)){
                    //Update entity and set description to live
                    $this->plan_model->update($THentity['id'], array('description'=>'live'));
                }else{
                    //update entity and set description to offline
                    $this->plan_model->update($THentity['id'], array('description'=>'offline'));
                }
            }

            $this->output->set_output(json_encode(array(
                'set' =>  TRUE
            )));
        }else{
            foreach($thData as $THentity){

                //update entity and set description to offline
                $this->plan_model->update($THentity['id'], array('description'=>'offline'));

            }

            $this->output->set_output(json_encode(array(
                'set' =>  TRUE
            )));

        }


    }

    public function updateSelectedTH(){
        if($this->input->post('ajax')){
            $THid = $this->input->post('THid');
            $value = $this->input->post('value');
            $vString = ($value==1)? "live" : "offline";

            $this->plan_model->update($THid, array('description'=>$vString));

            $this->output->set_output(json_encode(array(
                'set' =>  TRUE
            )));
        }
    }
}