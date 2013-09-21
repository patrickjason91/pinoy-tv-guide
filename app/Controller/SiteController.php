<?php

class SiteController extends AppController {
    
    public function configure() {
        $this->layout = 'config';
        $admin_count = $this->User->find('count', array(
            'conditions' => array('User.status' => 1)
        ));
        if ($admin_count <= 0) {
            $this->set('title_for_layout', 'First-Run Configuration - Pinoy TV Guide');
            if ($this->request->is('post')) {
                $this->request->data['User']['status'] = 1;                
                $this->User->create();
                if ($this->User->save($this->request->data)) {
                    //Configure::write('Conf.firstrun', true);
                    return $this->redirect('/');
                }
            }
        } else {
            return $this->redirect('/');
        }
    }
    
    public function not_configured() {
        $this->layout = 'config';
    }
}
