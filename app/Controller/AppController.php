<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array('RequestHandler');
    public $uses = array('Region', 'Channel','TvProgram', 'TvCategory', 'User', 'TvProgramSchedule');
    public $helpers = array('Js');
    public function beforeFilter() {
        parent::beforeFilter();
        date_default_timezone_set('Asia/Manila');
        $admin_count = $this->User->find('count', array(
            'conditions' => array('User.status' => 1)
        ));
        if ($admin_count <= 0) {
            if (!$this->_inConfigurePage()) {
                return $this->redirect('/configure');
            }
        }
    }
    
    protected function _inConfigurePage() {
        $controller = $this->request->params['controller'];
        $action = $this->request->params['action'];
        return $controller == 'site' AND $action == 'configure';
    }
}
