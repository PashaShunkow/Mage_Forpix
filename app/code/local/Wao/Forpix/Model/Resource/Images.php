<?php

class Wao_Forpix_Model_Resource_Images extends Mage_Core_Model_Mysql4_Abstract {

    protected function _construct() {
        $this->_init('forpix/images', 'id');
    }

}
