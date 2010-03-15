<?php
/**
 * 
 * Helper to build an Solar_Action_Uri for a named action from the rewrite
 * rules using data interpolation.
 * 
 * @category Solar
 * 
 * @package Solar_View_Helper
 * 
 * @author Paul M. Jones <pmjones@solarphp.com>
 * 
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * 
 * @version $Id: NamedActionUri.php 4506 2010-03-08 22:37:19Z pmjones $
 * 
 */
class Solar_View_Helper_NamedActionUri extends Solar_View_Helper
{
    /**
     * 
     * Returns an escaped href or src attribute value for a named action
     * from the rewrite rules, using data interpolation.
     * 
     * @param string $name The named action from the rewrite rules.
     * 
     * @param array $data Data to interpolate into the token placeholders.
     * 
     * @return string
     * 
     */
    public function namedActionUri($name, $data = null)
    {
        $href = $this->_view->namedActionHref($name, $data);
        return $this->_view->actionUri($href);
    }
}
