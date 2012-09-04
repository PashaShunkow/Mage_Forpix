<?php
class Wao_Singup_Model_Mysql4_Singup_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('singup/singup');
    }
}
