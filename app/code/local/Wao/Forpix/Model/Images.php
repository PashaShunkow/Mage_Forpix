<?php

class Wao_Forpix_Model_Images extends Mage_Core_Model_Abstract {

    protected function _construct() {
        parent::_construct();
        $this->_init('forpix/images');
    }

}

