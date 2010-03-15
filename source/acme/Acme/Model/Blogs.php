<?php
/**
 * 
 * Model class.
 * 
 */
class Acme_Model_Blogs extends Acme_Sql_Model
{
    /**
     * 
     * Establish state of this object prior to _setup().
     * 
     * @return void
     * 
     */
    protected function _preSetup()
    {
        // chain to parent
        parent::_preSetup();
        
        // use metadata generated from make-model
        $metadata          = Solar::factory('Acme_Model_Blogs_Metadata');
        $this->_table_name = $metadata->table_name;
        $this->_table_cols = $metadata->table_cols;
        $this->_index_info = $metadata->index_info;
    }
    
    /**
     * 
     * Model-specific setup.
     * 
     * @return void
     * 
     */
    protected function _setup()
    {
        // chain to parent
        parent::_setup();
	
	// add a validation filter on the status column
        $this->_addFilter('status', 'validateInList', array(
            'draft',
            'public',
        ));	
    }
}
