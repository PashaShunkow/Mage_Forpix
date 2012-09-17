<?php

class Wao_Singup_Block_Edit extends Wao_Singup_Block_Account {

    protected function _construct() {
        $this->session = Mage::getSingleton('core/session')->getFPUser();
        $this->setTemplate('wao/singup/singEdit.phtml');
    }
    
    public function getNamePart($name, $i)
    {
        $name = explode('.', $name);
        return $name[$i];
    }

}

