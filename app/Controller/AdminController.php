<?php

class AdminController extends AppController {
    public $components = array(
        'Auth' => array(
            'loginAction' => array('action' => 'login'),
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'User',
                    'fields' => array(
                        'username' => 'username',
                        'password' => 'password'),
                    'scope' => array('User.status' => 1),
                )),
            'loginRedirect' => array('action' => 'index'),
            'logoutRedirect' => array('action' => 'login')
        ),
        'Cookie' => array(
            'name' => 'admin_login_cookie'
        )
    );
    public $helpers = array('Js' => array('Jquery'));
    
    var $title_append = '- Pinoy TV Guide Admin Panel';
    
    public function __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        $this->layout = 'admin';
    }
    
    public function index() {
        $channels = $this->Channel->find('count', array(
        ));
        $programs = $this->TvProgram->find('count', array(
        ));
        $categories = $this->TvCategory->find('count', array(
        ));
        $all_users = $this->User->find('count');
        $admins = $this->User->find('count', array(
            'conditions' => array('User.status' => 1)
        ));
        $this->set('channels', $channels);
        $this->set('programs', $programs);
        $this->set('categories', $categories);
        $this->set('all_users', $all_users);
        $this->set('admins', $admins);
        $this->set('title_for_layout', "Dashboard $this->title_append");
    }
    
    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
               return $this->redirect($this->Auth->redirect());
            }
        }
        if ($this->Auth->loggedIn()) {
            return $this->redirect('/admin');
        }
        $this->set('title_for_layout', "Login $this->title_append");
    }
    
    public function logout() {
        $this->autoRender = false;
        $this->redirect($this->Auth->logout());
    }
    
    public function add_user() {
        if ($this->request->is('post')) {           
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->_redirectToDashboard();
            }
        }
        $this->set('title_for_layout', "Add User $this->title_append");
    }
    
    public function add_channel() {
        $regions = $this->Region->find('list', array(
            'fields' => array('Region.region_id', 'Region.region_name'),
            'order' => 'Region.region_name ASC'
        ));
        $this->set('region_options', $regions);
        if ($this->request->is('post')) {
            $this->Channel->create();
            if ($this->Channel->save($this->request->data)) {
                return $this->redirect('/admin/channels');
            }
        }
        $this->set('title_for_layout', "Add TV Channel $this->title_append");
    }
    
    public function add_tv_program() {
        $categories = $this->TvCategory->find('list', array(
            'fields' => array('TvCategory.tv_category_id','TvCategory.category_name'),
            'order' => array('TvCategory.category_name')
        ));
        $this->set('categories_list', $categories);
        if ($this->request->is('post')) {
            $this->TvProgram->create();
            if ($this->TvProgram->save($this->request->data)) {
                return $this->redirect('/admin/tv_programs');
            }
        }
        $this->set('title_for_layout', "Add TV Program $this->title_append");
    }
    
    public function add_schedules() {
        $channels = $this->Channel->find('list', array(
            'fields' => array('Channel.channel_id', 'Channel.channel_name'),
            'order' => array('Channel.channel_no'),
            'conditions' => array('Channel.region_id' => 1)
        ));
        $programs = $this->TvProgram->find('list', array(
            'fields' => array('TvProgram.program_id', 'TvProgram.program_name'),
            'order' => array('TvProgram.program_name')
        ));
        $this->set('all_channels', $channels);
        $this->set('all_programs', $programs);
        if ($this->request->is('post')) {
            $tv_prog_sched_base = array('TvProgramSchedule' => array());
            
            $data = $this->request->data;
            $tv_prog = $data['TvProgramSchedule'];
            
            $time_start = $tv_prog['time_start'];
            $time_end = $tv_prog['time_end'];
            $sched_day = $tv_prog['sched_day'];
            // TODO Algos to handle the validation, processing and saving of TV schedule data from add schedule form
            
            $data['TvProgramSchedule'] = $tv_prog;
            if (isset($tv_prog['occurrence'])) {
                // date data from sched_day
                $date_imploded = $sched_day['year'] . '-' . $sched_day['month'] . '-' . $sched_day['day'];
                $date_starting = date_create($date_imploded);
                $date_timestamp = $date_starting->getTimestamp();
                $date_starting_info = getdate($date_timestamp);
                $dwk_start = $date_starting_info['wday'];
                
                // date data from the time_end
                $time_end_imploded = $time_end['year'] . '-' . $time_end['month'] . '-' . $time_end['day'];
                $time_end_date = date_create($time_end_imploded);
                $t_timestamp = $time_end_date->getTimestamp();
                $t_starting_info = getdate($t_timestamp);
                $t_dwk_start = $t_starting_info['wday'];
                
                $tv_prog['time_start']['month'] = $sched_day['month'];
                $tv_prog['time_start']['day'] = $sched_day['day'];
                $tv_prog['time_start']['year'] = $sched_day['year'];
                $data['TvProgramSchedule'] = $tv_prog;
                
                if ($tv_prog['occurrence'] == 1) {
                    $this->TvProgramSchedule->create();
                    if ($this->TvProgramSchedule->save($data)) {
                        $this->_redirectToDashboard();
                    }
                } else if ($tv_prog['occurrence'] == 2) {
                    
                    $sched_dates = array();
                    
                    for($i = $dwk_start,$j = 0; $i <= 5 && $i > 0; $j++) {
                        $tv_sched_vals = array(
                            'program_id' => $tv_prog['program_id'],
                            'channel_id' => $tv_prog['channel_id'],
                            'alternate_name' => $tv_prog['alternate_name']
                        );
                    
                        //$tv_sched_base = array('TvProgramSchedule'=> $tv_sched_vals);
                        
                        if ($j == 0) {
                            $sched_dates[] = $data;
                            $i++;
                            continue;
                        }
                        
                        $nth_day = $date_starting->add(new DateInterval("P1D"));
                        $nth_day_timestamp = $nth_day->getTimestamp();
                        $nth_day_arr = getdate($nth_day_timestamp);
                        $nth_sched_day = array(
                            'month' => $nth_day_arr['mon'],
                            'day' => $nth_day_arr['mday'],
                            'year' => $nth_day_arr['year']
                        );
                        
                        $nth_day_start = $nth_sched_day;
                        $nth_day_start['hour'] = $time_start['hour'];
                        $nth_day_start['min'] = $time_start['min'];
                        $nth_day_start['meridian'] = $time_start['meridian'];
                        
                        $nth_day_end_date = $time_end_date->add(new DateInterval("P1D"));
                        $nth_day_end_timestamp = $nth_day_end_date->getTimestamp();
                        $nth_day_end_arr = getdate($nth_day_end_timestamp);
                        $nth_day_end = array(
                            'month' => $nth_day_end_arr['mon'],
                            'day' => $nth_day_end_arr['mday'],
                            'year' => $nth_day_end_arr['year'],
                            'hour' => $time_end['hour'],
                            'min' => $time_end['min'],
                            'meridian' => $time_end['meridian']
                        );
                        
                        $tv_sched_vals['sched_day'] = $nth_sched_day;
                        $tv_sched_vals['time_start'] = $nth_day_start;
                        $tv_sched_vals['time_end'] = $nth_day_end;
                        $tv_base = array('TvProgramSchedule' => $tv_sched_vals);
                        $sched_dates[] = $tv_base;
                        $i++;
                    }
                    if (count($sched_dates) > 0) {
                        if($this->TvProgramSchedule->saveMany($sched_dates)) {
                            $this->redirect('/admin/tv_programs');
                        }
                    }
                } else if ($tv_prog['occurrence'] == 3 && is_numeric($tv_prog['n_repeat'])) {
                    $repeat = $tv_prog['n_repeat'];
                    $sched_dates = array();
                    for($i = 0; $i < $repeat; $i++) {
                        $tv_sched_vals = array(
                            'program_id' => $tv_prog['program_id'],
                            'channel_id' => $tv_prog['channel_id'],
                            'alternate_name' => $tv_prog['alternate_name']
                        );
                    
                        //$tv_sched_base = array('TvProgramSchedule'=> $tv_sched_vals);
                        
                        if ($i == 0) {
                            $sched_dates[] = $data;
                            continue;
                        }
                        
                        $nth_day = $date_starting->add(new DateInterval("P1D"));
                        $nth_day_timestamp = $nth_day->getTimestamp();
                        $nth_day_arr = getdate($nth_day_timestamp);
                        $nth_sched_day = array(
                            'month' => $nth_day_arr['mon'],
                            'day' => $nth_day_arr['mday'],
                            'year' => $nth_day_arr['year']
                        );
                        
                        $nth_day_start = $nth_sched_day;
                        $nth_day_start['hour'] = $time_start['hour'];
                        $nth_day_start['min'] = $time_start['min'];
                        $nth_day_start['meridian'] = $time_start['meridian'];
                        
                        $nth_day_end_date = $time_end_date->add(new DateInterval("P1D"));
                        $nth_day_end_timestamp = $nth_day_end_date->getTimestamp();
                        $nth_day_end_arr = getdate($nth_day_end_timestamp);
                        $nth_day_end = array(
                            'month' => $nth_day_end_arr['mon'],
                            'day' => $nth_day_end_arr['mday'],
                            'year' => $nth_day_end_arr['year'],
                            'hour' => $time_end['hour'],
                            'min' => $time_end['min'],
                            'meridian' => $time_end['meridian']
                        );
                        
                        $tv_sched_vals['sched_day'] = $nth_sched_day;
                        $tv_sched_vals['time_start'] = $nth_day_start;
                        $tv_sched_vals['time_end'] = $nth_day_end;
                        $tv_base = array('TvProgramSchedule' => $tv_sched_vals);
                        $sched_dates[] = $tv_base;
                    }
                    if (count($sched_dates) > 0) {
                        if($this->TvProgramSchedule->saveMany($sched_dates)) {
                            $this->redirect('/admin/tv_programs');
                        }
                    }
                } else if ($tv_prog['occurrence'] == 4 && is_numeric($tv_prog['n_repeat'])) {
                    $repeat = $tv_prog['n_repeat'];
                    $sched_dates = array();
                    for($i = 0; $i < $repeat; $i++) {
                        $tv_sched_vals = array(
                            'program_id' => $tv_prog['program_id'],
                            'channel_id' => $tv_prog['channel_id'],
                            'alternate_name' => $tv_prog['alternate_name']
                        );
                    
                        //$tv_sched_base = array('TvProgramSchedule'=> $tv_sched_vals);
                        
                        if ($i == 0) {
                            $sched_dates[] = $data;
                            continue;
                        }
                        
                        $nth_day = $date_starting->add(new DateInterval("P1W"));
                        $nth_day_timestamp = $nth_day->getTimestamp();
                        $nth_day_arr = getdate($nth_day_timestamp);
                        $nth_sched_day = array(
                            'month' => $nth_day_arr['mon'],
                            'day' => $nth_day_arr['mday'],
                            'year' => $nth_day_arr['year']
                        );
                        
                        $nth_day_start = $nth_sched_day;
                        $nth_day_start['hour'] = $time_start['hour'];
                        $nth_day_start['min'] = $time_start['min'];
                        $nth_day_start['meridian'] = $time_start['meridian'];
                        
                        $nth_day_end_date = $time_end_date->add(new DateInterval("P1W"));
                        $nth_day_end_timestamp = $nth_day_end_date->getTimestamp();
                        $nth_day_end_arr = getdate($nth_day_end_timestamp);
                        $nth_day_end = array(
                            'month' => $nth_day_end_arr['mon'],
                            'day' => $nth_day_end_arr['mday'],
                            'year' => $nth_day_end_arr['year'],
                            'hour' => $time_end['hour'],
                            'min' => $time_end['min'],
                            'meridian' => $time_end['meridian']
                        );
                        
                        $tv_sched_vals['sched_day'] = $nth_sched_day;
                        $tv_sched_vals['time_start'] = $nth_day_start;
                        $tv_sched_vals['time_end'] = $nth_day_end;
                        $tv_base = array('TvProgramSchedule' => $tv_sched_vals);
                        $sched_dates[] = $tv_base;
                    }
                    if (count($sched_dates) > 0) {
                        if($this->TvProgramSchedule->saveMany($sched_dates)) {
                            $this->redirect('/admin/tv_programs');
                        }
                    }
                }
            }
        }
        $this->set('title_for_layout', "Add TV Program Schedules $this->title_append");
    }
    
    public function add_tv_category() {
        $all_categs = $this->TvCategory->find('list',array(
            'fields' => array('TvCategory.tv_category_id','TvCategory.category_name'),
            'order' => array('TvCategory.category_name ASC')
        ));
        $this->set('all_categories', $all_categs);
        if ($this->request->is('post')) {
            $this->TvCategory->create();
            if($this->TvCategory->save($this->request->data)) {
                $this->_redirectToDashboard();
            }
        }
        $this->set('title_for_layout', "Add TV Category $this->title_append");
    }
    
    public function add_region() {
        if ($this->request->is('post')) {
            $this->Region->create();
            if ($this->Region->save($this->request->data)) {
                $this->_redirectToDashboard();
            }
        }
        $this->set('title_for_layout', "Add Region $this->title_append");
    }
    
    public function channels() {
        $this->paginate = array(
            'Channel' => array(
                'limit' => 10,
                'order' => array('Channel.channel_name'),
                'conditions' => array('Channel.region_id' => 1)
            )
        );
        $paginated = $this->paginate('Channel');
        $regions = $this->Region->find('list', array(
            'fields' => array('Region.region_id', 'Region.region_name'),
            'order' => array('Region.region_name')
        ));
        $this->set('regions_list', $regions);
        if (!isset($_GET['region_id'])) {
            $channels = $this->Channel->find('all', array(
                'fields' => array('Channel.channel_id', 'Channel.channel_name', 'Channel.channel_no'),
                'order' => array('Channel.channel_no'),
                'conditions' => array('Channel.region_id' => 1)
            ));
            $this->set('channels_list', $channels);
        } else {
            $region_id = $_GET['region_id'];
            if (is_numeric($region_id)) {
                $channels_by_region = $this->Channel->find('all', array(
                    'fields' => array('Channel.channel_id', 'Channel.channel_name', 'Channel.channel_no'),
                    'order' => array('Channel.channel_no'),
                    'conditions' => array('Channel.region_id' => $region_id)
                ));
                $this->set('channels_list', $channels_by_region);                
            }
        }
        $this->set('title_for_layout', "TV Channels $this->title_append");
    }
    
    public function tv_programs() {
        $programs_by_channels = $this->Channel->find('all', array(
            
        ));
        $categories = $this->TvCategory->find('list', array(
            'fields' => array('TvCategory.tv_category_id','TvCategory.category_name'),
            'order' => array('TvCategory.category_name')
        ));
        $this->set('categories_list', $categories);
        $this->set('programs_by_channels', $programs_by_channels);
        $this->set('title_for_layout', "TV Programs $this->title_append");
    }
    
    public function users() {
        if (!isset($_GET['utype'])) {
            $users = $this->User->find('all', array(
                'order' => array('User.username'),
            ));
            $this->set('users_list', $users);
        } else {
            
        }
        $this->set('title_for_layout', "Users/Admins $this->title_append");
    }
    
    public function regions() {
        $regions = $this->Region->find('all', array(
            'order' => array('Region.region_name')
        ));
        $this->set('regions_list', $regions);
        $this->set('title_for_layout', "Regions $this->title_append");
    }
    
    public function edit_user($user_id) {
        if (isset($user_id) && is_numeric($user_id)) {
            if (empty($this->request->data)) {
                $current_user = $this->User->findByUserId($user_id);
                $this->request->data = $current_user;
            } else {
                $this->request->data['User']['user_id'] = $user_id;
                if ($this->User->save($this->request->data)) {
                    $this->redirect('/admin/users');
                }
            }
        } else {
            $this->flash("No such user exists", '/admin/users', 3);
        }
    }
    
    public function edit_channel($channel_id) {
        if (isset($channel_id) && is_numeric($channel_id)) {
            $region_options = $this->Region->find('list', array(
                'fields' => array('Region.region_id', 'Region.region_name')
            ));
            $this->set('region_options', $region_options);
            $this->Channel->hasMany = array();
            if (empty($this->request->data)) {
                $current_channel = $this->Channel->findByChannelId($channel_id);
                $this->request->data = $current_channel;
                $this->set('current_channel', $current_channel);
            } else {
                $this->request->data['Channel']['channel_id'] = $channel_id;
                if ($this->Channel->save($this->request->data)) {
                    return $this->redirect('/admin/channels');
                }
            }
        } else {
            $this->flash("No such channel exists", '/admin/channels', 3);
        }
    }
    
    public function edit_program($channel_id) {
        
    }
    
    public function edit_region($region_id) {
        if (isset($region_id) && is_numeric($region_id)) {
            if (empty($this->request->data)) {
                $current_region = $this->Region->findByRegionId($region_id);
                $this->request->data = $current_region;
            } else {
                $this->request->data['Region']['region_id'] = $region_id;
                if ($this->Region->save($this->request->data)) {
                    return $this->redirect('/admin/regions');
                }
            }
        } else {
            $this->flash('No such region exists', '/admin/regions', 3);
        }
    }
    
    public function edit_schedules($schedule_id) {
        
    }
    
    public function get_schedules_ajax() {
        
        if (isset($_GET['sched_date'])) {
            $date = $_GET['sched_date'];

            $this->layout = 'ajax';
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
                        'TvProgramSchedule.sched_day' => $date
                ),
                'order' => array('Channel.channel_no','TvProgramSchedule.time_start','TvProgramSchedule.time_end'),
            ));
            $this->set('schedules_array', $channels);
        } else {
            
        }
    }
    
    private function _redirectToDashboard() {
        $this->redirect('/admin');
    }
    
    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->fields = array(
            'username' => 'username',
            'password' => 'password'
        );
        $this->set('users', $this->Auth->user());
    }
}
