<?php
/**
 * 
 * Generic application.
 * 
 */
class Acme_App_Blog extends Acme_Controller_Page
{

    protected $_action_default = 'index';

    protected $_model;

    public $list;

    public $item;

    public $form;

    protected function _setup()
    {
        parent::_setup();
        $this->_model = Solar_Registry::get('model_catalog');
    }
    /**
     * 
     * Generic index action.
     * 
     * @return void
     * 
     */
    public function actionIndex()
    {
        // public blog articles in descending order, all result pages
        $fetch = array(
            'where' => array('blogs.status = ?' => 'public'),
            'order' => 'blogs.created DESC',
            'page'  => 'all',
        );
    
        // fetch all matching records
        $this->list = $this->_model->blogs->fetchAll($fetch);
        
    }
}
