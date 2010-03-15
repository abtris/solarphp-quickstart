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
    
    public function actionEdit($id = null)
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
    
        // did the user click the save button?
        if ($this->_isProcess('save')) {
            // look for $_POST['blog'] in the request,
            // load into the record, and save it.
            $data = $this->_request->post('blog');
            $this->item->load($data);
            $this->item->save();
        }
    
        // get form hints from the record
        $this->form = $this->item->newForm();
        
        // turn off http caching
        $this->_response->setNoCache();
    }    
    
    public function actionAdd()
    {
        // get a new default record
        $this->item = $this->_model->blogs->fetchNew();
    
        // did the user click the save button?
        if ($this->_isProcess('save')) {
        
            // look for $_POST['blog'] in the request,
            // and load into the record.
            $data = $this->_request->post('blog');
            $this->item->load($data);
        
            // attempt to save it, and redirect to editing on success
            if ($this->item->save()) {
                $uri = "/{$this->_controller}/edit/{$this->item->id}";
                return $this->_redirectNoCache($uri);
            }
        }
    
        // get form hints from the record
        $this->form = $this->item->newForm();
        
        // turn off http caching
        $this->_response->setNoCache();
    }    
    
    public function actionDelete($id = null)
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
        
        // did the user click the delete button?
        if ($this->_isProcess('delete')) {
            $this->item->delete();
            $this->_view = 'deleteSuccess';
        }
    }    
}
