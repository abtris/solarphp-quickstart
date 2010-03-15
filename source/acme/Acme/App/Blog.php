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
    
    public function actionRead($id = null)
    {
        // was an ID specified?
        if (! $id) {
            return $this->_error('ERR_NO_ID_SPECIFIED');
        }
    
        // fetch one blog article by ID
        $this->item = $this->_model->blogs->fetch($id);
    
        // did the blog article exist?
        if (! $this->item) {
            return $this->_error('ERR_NO_SUCH_ITEM');
        }
    }    
    
    public function actionDrafts()
    {
        // draft blog articles in ascending order, all result pages
        $fetch = array(
            'where' => array('blogs.status = ?' => 'draft'),
            'order' => 'blogs.created ASC',
            'page'  => 'all',
        );
    
        // fetch all matching records
        $this->list = $this->_model->blogs->fetchAll($fetch);
    }    
    
}
