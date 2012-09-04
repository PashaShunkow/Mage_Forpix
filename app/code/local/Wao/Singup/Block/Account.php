<?php

class Wao_Singup_Block_Account extends Wao_Singup_Block_AbstractForm {

    protected function _construct() {
        $this->setTemplate('wao/singup/singAccount.phtml');
        $this->session = Mage::getSingleton('core/session')->getFPUser();
    }
    
    public function getImages()
    {
        $data = Mage::getModel('forpix/images')->getCollection()->addFieldToFilter('user_login',$this->session['login']);
        return $data;
    }
}
