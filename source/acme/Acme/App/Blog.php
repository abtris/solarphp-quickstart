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
     * The default action when no action is specified.
     * 
     * @var string
     * 
     */
    protected $_action_default = 'index';
    
    /**
     * 
     * Generic index action.
     * 
     * @return void
     * 
     */
    public function actionIndex()
    {
        
    }
}
