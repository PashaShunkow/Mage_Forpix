<?php
class Wao_Forpix_Model_Resource_Images_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('forpix/images');
    }
}