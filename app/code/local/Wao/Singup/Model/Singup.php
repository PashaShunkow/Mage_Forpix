<?php
class Wao_Singup_Model_Singup extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('singup/singup');
    }
}