<?php

App::uses('AppController', 'Controller');

class ListingsApiController extends AppController {
    public $components  = array('RequestHandler');
    public $name = 'listingsapi';
    public function index() {
        
        $curr_date = getdate();
        $curr_hour = $curr_date['hours'];
        $this->Channel->hasMany = array();
        $this->Channel->belongsTo = array();
        
        $channels = $this->Channel->find('all', array(
            'fields' => array('Channel.channel_id','Channel.channel_no', 'Channel.channel_name','TvProgram.program_id',
                        'TvProgram.program_name', 'TvCategory.category_name','TvProgramSchedule.time_start',
                        'TvProgramSchedule.time_end'),
            'joins' => array(
                array(
                    'table' => 'tv_program_schedule',
                    'alias' => 'TvProgramSchedule',
                    'conditions' => array(
                        'Channel.channel_id = TvProgramSchedule.channel_id'
                    )
                ),
                array(
                    'table' => 'tv_program',
                    'alias' => 'TvProgram',
                    'conditions' => array(
                        'TvProgram.program_id = TvProgramSchedule.program_id'
                    )
                ),
                array(
                    'table' => 'tv_category',
                    'alias' => 'TvCategory',
                    'conditions' => array(
                        'TvCategory.tv_category_id = TvProgram.tv_category_id'
                    )
                )
            ),
            'conditions' => array(
                    'TvProgramSchedule.sched_day' => date('Y-m-d'),
                    "(
                        $curr_hour - hour(TvProgramSchedule.time_start) >= 0 AND $curr_hour - hour(TvProgramSchedule.time_start) <= hour(TvProgramSchedule.time_end) - hour(TvProgramSchedule.time_start)
                     )"
            ),
            'order' => array('Channel.channel_no','TvProgramSchedule.time_start','TvProgramSchedule.time_end'),
        ));
        $this->set('json_array', $channels);
        $this->RequestHandler->respondAs('application/json');
    }
    
    public function by_channel_no($channel_no) {
        if (isset($channel_no)) {
            $curr_date = getdate();
            $curr_hour = $curr_date['hours'];
            $this->Channel->hasMany = array();
            $this->Channel->belongsTo = array();
                
            $channels = $this->Channel->find('all', array(
                'fields' => array('Channel.channel_id','Channel.channel_no', 'Channel.channel_name','TvProgram.program_id',
                            'TvProgram.program_name', 'TvCategory.category_name','TvProgramSchedule.time_start',
                            'TvProgramSchedule.time_end'),
                'joins' => array(
                    array(
                        'table' => 'tv_program_schedule',
                        'alias' => 'TvProgramSchedule',
                        'conditions' => array(
                            'Channel.channel_id = TvProgramSchedule.channel_id'
                        )
                    ),
                    array(
                        'table' => 'tv_program',
                        'alias' => 'TvProgram',
                        'conditions' => array(
                            'TvProgram.program_id = TvProgramSchedule.program_id'
                        )
                    ),
                    array(
                        'table' => 'tv_category',
                        'alias' => 'TvCategory',
                        'conditions' => array(
                            'TvCategory.tv_category_id = TvProgram.tv_category_id'
                        )
                    )
                ),
                'conditions' => array(
                    'Channel.channel_no' => $channel_no,
                    'Channel.region_id' => 1,
                    'TvProgramSchedule.sched_day' => date('Y-m-d'),
                    "
                        (
                        hour(TvProgramSchedule.time_start) >= $curr_hour OR hour(TvProgramSchedule.time_end) >= $curr_hour
                        )
                    "
                ),
                'order' => array('TvProgramSchedule.time_start','TvProgramSchedule.time_end')
            ));
        } else {
            
        }
        $this->set('json_array', $channels);
        $this->RequestHandler->respondAs('application/json');
        $this->render('/ListingsApi/index');
    }
    
    public function by_specific_hour($hour) {
        $this->Channel->hasMany = array();
        $this->Channel->belongsTo = array();
        $schedules = array();
        if (isset($hour)) {
             $schedules = $this->Channel->find('all', array(
                'fields' => array('Channel.channel_id','Channel.channel_no', 'Channel.channel_name','TvProgram.program_id',
                            'TvProgram.program_name', 'TvCategory.category_name','TvProgramSchedule.time_start',
                            'TvProgramSchedule.time_end'),
                'joins' => array(
                    array(
                        'table' => 'tv_program_schedule',
                        'alias' => 'TvProgramSchedule',
                        'conditions' => array(
                            'Channel.channel_id = TvProgramSchedule.channel_id'
                        )
                    ),
                    array(
                        'table' => 'tv_program',
                        'alias' => 'TvProgram',
                        'conditions' => array(
                            'TvProgram.program_id = TvProgramSchedule.program_id'
                        )
                    ),
                    array(
                        'table' => 'tv_category',
                        'alias' => 'TvCategory',
                        'conditions' => array(
                            'TvCategory.tv_category_id = TvProgram.tv_category_id'
                        )
                    )
                ),
                'conditions' => array(
                        'TvProgramSchedule.sched_day' => date('Y-m-d'),
                        "(
                            $hour - hour(TvProgramSchedule.time_start) >= 0 AND $hour - hour(TvProgramSchedule.time_start) <= hour(TvProgramSchedule.time_end) - hour(TvProgramSchedule.time_start)
                        )"
                ),
                'order' => array('Channel.channel_no','TvProgramSchedule.time_start','TvProgramSchedule.time_end'),
            ));
        }
        $this->set('json_array', $schedules);
        $this->RequestHandler->respondAs('application/json'); 
        $this->render('/ListingsApi/index');
    }
    
    private function is_valid_hour() {
        
    }
    
    public function available_channels($region_id = 1) {
        $channels_list = $this->Channel->find('list', array(
            'fields' => array('Channel.channel_no', 'Channel.channel_name'),
            'conditions' => array(
                'Channel.region_id' => $region_id,
            )
        ));
        $this->set('json_array', $channels_list);
        $this->RequestHandler->respondAs('application/json');
        $this->render('/ListingsApi/index');
    }
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->RequestHandler->setContent('json', 'application/json');
        $this->layout = 'json';
    }
}