<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

/**
 * This controller does not use a model
 *
 * @var array
 */
	// public $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
    public function display() {
            $path = func_get_args();

            $count = count($path);
            if (!$count) {
                    $this->redirect('/');
            }
            $page = $subpage = $title_for_layout = null;

            if (!empty($path[0])) {
                    $page = $path[0];
            }
            if (!empty($path[1])) {
                    $subpage = $path[1];
            }
            if (!empty($path[$count - 1])) {
                    $title_for_layout = Inflector::humanize($path[$count - 1]);
            }
            $this->set(compact('page', 'subpage', 'title_for_layout'));
            $this->render(implode('/', $path));
    }

    public function home() {
        $curr_date = getdate();
        $curr_hour = $curr_date['hours'];
        $this->Channel->hasMany = array();
        $this->Channel->belongsTo = array();
        $sched_current_hour = $this->Channel->find('all', array(
            'fields' => array('Channel.channel_id','Channel.channel_no', 'Channel.channel_name','TvProgram.program_id',
                        'TvProgram.program_name', 'TvProgram.tv_category_id','TvProgramSchedule.tv_schedule_id',
                        'TvProgramSchedule.time_start','TvProgramSchedule.time_end'),
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
        $this->set('all_current_hour_schedules', $sched_current_hour);
        
        $this->set('title_for_layout', 'Mabuhay | Pinoy TV Guide');
        $ten_channels = $this->Channel->find('list', array(
                        'fields' => array('channel_id','channel_name'),
                        'conditions' => array(
                            'Channel.region_id' => 1
                        ),
                        'order' => array('channel_no ASC'),
                        'limit' => 10
                    )
                );
        $data = array(
            'ten_channels' => $ten_channels
        );
        $this->set($data);
    }

    public function about() {
        
    }

    public function contact() {

    }
}
