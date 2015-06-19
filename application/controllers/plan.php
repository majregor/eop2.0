<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){
            $this->load->model('plan_model');

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
            $thData = $this->plan_model->getEntities('th');
            if(is_array($thData)){
                $data['entities'] = $thData;
            }
        }
        elseif($step==3){
            $thData = $this->plan_model->getEntities('th',null,true);
            if(is_array($thData)){
                $data['entities'] = $thData;
            }
        }
        elseif($step==4){
            $fnData = $this->plan_model->getEntities('fn', array('parent is not null'=>Null), false, array('orderby'=>'name', 'type'=>'ASC'));
            $topLevelFns = $this->plan_model->getEntities('fn', array('parent'=>Null), true, array('orderby'=>'name', 'type'=>'ASC'));
            $cleanedFns= array();
            foreach($topLevelFns as $key=>$value){

                foreach($fnData as $v){
                    if($value['name'] == $v['name']){
                        array_push($cleanedFns, $value);
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
            $thData = $this->plan_model->getEntities('th',null,true);
            if(is_array($thData)){
                $data['entities'] = $thData;
            }
        }

        if($step==4){
            $fnData = $this->plan_model->getEntities('fn', array('parent is not null'=>Null), false, array('orderby'=>'name', 'type'=>'ASC'));
            $topLevelFns = $this->plan_model->getEntities('fn', array('parent'=>Null), true, array('orderby'=>'name', 'type'=>'ASC'));
            $cleanedFns= array();
            foreach($topLevelFns as $key=>$value){

                foreach($fnData as $v){
                    if($value['name'] == $v['name']){
                        array_push($cleanedFns, $value);
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
            $thData = $this->plan_model->getEntities('th',null,true);
            if(is_array($thData)){
                $data['entities'] = $thData;
                $data['showActions']=true;
            }
        }
        elseif($step==3) {
            $fnData = $this->plan_model->getEntities('fn', array('parent is not null' => Null), false, array('orderby' => 'name', 'type' => 'ASC'));
            $topLevelFns = $this->plan_model->getEntities('fn', array('parent' => Null), true, array('orderby' => 'name', 'type' => 'ASC'));
            $cleanedFns = array();
            foreach ($topLevelFns as $key => $value) {

                foreach ($fnData as $v) {
                    if ($value['name'] == $v['name']) {
                        array_push($cleanedFns, $value);
                        break;
                    }
                }
            }
            if(is_array($fnData)){
                $data['entities'] = $cleanedFns;
            }
        }
        elseif($step==4){


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

    public function test(){
        $thData = $this->plan_model->getEntities('th',null,true);
        $data =array('dump' => $thData);
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
                $thData = $this->plan_model->getEntities('th');
            }else{
                $p = array('id' =>$param);
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
                    }

                    $this->load->view('ajax/step3_th_goals', $data);
                    break;
                case 'edit':
                    $fnData = $this->plan_model->getEntities('fn', array('parent'=>null), false, array('orderby'=>'name', 'type'=>'ASC')); // Get function Entities
                    $thData = $this->plan_model->getEntities('th', array('id'=>$id), true);
                    $data = array(
                        'entity_id'                 =>  $id,
                        'functions'                 =>  $fnData,
                        'threats_and_hazards'       =>  $thData,
                        'action'                    =>  'edit'
                    );
                    if($showActions){
                        $data['showActions']=true;
                    }

                    $this->load->view('ajax/step3_th_goals', $data);
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
                    $fnData = $this->plan_model->getEntities('fn', array('parent is not null'=>Null), false, array('orderby'=>'name', 'type'=>'ASC'));
                    $topLevelFns = $this->plan_model->getEntities('fn', array('parent'=>Null), true, array('orderby'=>'name', 'type'=>'ASC'));
                    $cleanedFns= array();
                    foreach($topLevelFns as $key=>$value){

                        foreach($fnData as $v){
                            if($value['name'] == $v['name']){
                                array_push($cleanedFns, $value);
                                break;
                            }
                        }
                    }


                    $data = array(
                        'entity_id'                 =>  $id,
                        'functions'                 =>  $cleanedFns,
                        'action'                    =>  'add'
                    );
                    if($showActions){
                        $data['showActions']=true;
                    }

                    $this->load->view('ajax/step3_add_fn_goals', $data);
                    break;

                case 'edit':
                    $fnData = $this->plan_model->getEntities('fn', array('parent is not null'=>Null), false, array('orderby'=>'name', 'type'=>'ASC'));
                    $topLevelFns = $this->plan_model->getEntities('fn', array('parent'=>Null), true, array('orderby'=>'name', 'type'=>'ASC'));
                    $cleanedFns= array();
                    foreach($topLevelFns as $key=>$value){

                        foreach($fnData as $v){
                            if($value['name'] == $v['name']){
                                array_push($cleanedFns, $value);
                                break;
                            }
                        }
                    }

                    $data = array(
                        'entity_id'                 =>  $id,
                        'functions'                 =>  $cleanedFns,
                        'action'                    =>  'add'
                    );
                    if($showActions){
                        $data['showActions']=true;
                    }

                    $this->load->view('ajax/step3_edit_fn_goals', $data);
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
                    $thData = $this->plan_model->getEntities('th', array('id'=>$id), true);
                    $data = array(
                        'entity_id'                 =>  $id,
                        'threats_and_hazards'       =>  $thData,
                        'action'                    =>  'update'
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
                    $fnData = $this->plan_model->getEntities('fn', array('id'=>$id), true);
                    $data = array(
                        'entity_id'                 =>  $id,
                        'functions'       =>  $fnData,
                        'action'                    =>  'update'
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
                    //Update the defaul goals and objectives

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
                       // (trim(strtolower($fn1data['name'])) != "--select--") ? $recs = $this->plan_model->update($fn1Val, $fn1data) : $recs = 0;
                       // (trim(strtolower($fn2data['name'])) != "--select--") ? $recs = $this->plan_model->update($fn2Val, $fn2data) : $recs = 0;
                       // (trim(strtolower($fn3data['name'])) != "--select--") ? $recs = $this->plan_model->update($fn3Val, $fn3data) : $recs = 0;
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
                               // (trim(strtolower($fnData['name'])) != "--select--") ? $this->plan_model->update($g1fnVal[$key], $fnData) : '';
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
                               // (trim(strtolower($fnData['name'])) != "--select--") ? $this->plan_model->update($g2fnVal[$key], $fnData): '';
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
                                //(trim(strtolower($fnData['name'])) != "--select--") ? $this->plan_model->update($g3fnVal[$key], $fnData): '';
                            }
                        }
                    }

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

                        $fndata = array(
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
                            'parent'    =>      $g1Id,
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

                        $fndata = array(
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
                            'parent'    =>      $g1Id,
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

                        $fndata = array(
                            'name'      =>      $g3fnDataNew[$key],
                            'title'     =>      $g3fnDataNew[$key],
                            'parent'    =>      $insertedEntityId,
                            'owner'     =>      $this->session->userdata('user_id'),
                            'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                            'type_id'   =>      $this->plan_model->getEntityTypeId('fn', 'name')
                        );
                        (trim(strtolower($fnData['name'])) != "--select--") ? $this->plan_model->addTHFn($fnData): '';
                    }

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
                $THid    = $this->input->post('THid');
                $THData  = $this->input->post('THData');
                $fieldId = $this->input->post('fieldId');
                $mode    = $this->input->post('mode');

            if($mode == 'add'){
                if($this->plan_model->fieldExists($fieldId)){
                    $this->plan_model->updateField($fieldId, array('body'=>$THData));
                }else{
                    $fieldData = array(
                        'entity_id' =>      $THid,
                        'name'      =>      'Threat and Hazard Course of Action',
                        'title'     =>      'Course of Action',
                        'weight'    =>      1,
                        'type'      =>      'text',
                        'body'      =>      $THData
                    );
                    $this->plan_model->addField($fieldData);
                }

                $this->output->set_output(json_encode(array(
                    'saved' =>  TRUE
                )));

            }else{
                $this->plan_model->updateField($fieldId, array('body'=>$THData));

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
            $FNData  = $this->input->post('FNData');
            $fieldId = $this->input->post('fieldId');
            $mode    = $this->input->post('mode');

            if($mode == 'add'){
                if($this->plan_model->fieldExists($fieldId)){
                    $this->plan_model->updateField($fieldId, array('body'=>$FNData));
                }else{
                    $fieldData = array(
                        'entity_id' =>      $FNid,
                        'name'      =>      'Functional Course of Action',
                        'title'     =>      'Course of Action',
                        'weight'    =>      1,
                        'type'      =>      'text',
                        'body'      =>      $FNData
                    );
                    $this->plan_model->addField($fieldData);
                }

                $this->output->set_output(json_encode(array(
                    'saved' =>  TRUE
                )));

            }else{
                $this->plan_model->updateField($fieldId, array('body'=>$FNData));

                $this->output->set_output(json_encode(array(
                    'saved' =>  TRUE
                )));
            }

        }else{
            redirect('plan/step4/3');
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

    public function sessionSetSelectedTHs(){
        $this->session->unset_userdata('selected_ths');

        if($this->input->post('ajax') && $this->input->post('THids')){
            $THids = $this->input->post('THids');

            $this->session->set_userdata('selected_ths', $THids);

            $this->output->set_output(json_encode(array(
                'set' =>  TRUE
            )));
        }
    }
}