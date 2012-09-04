<?php

class Wao_Singup_Block_Edit extends Wao_Singup_Block_Account {

    protected function _construct() {
        $this->session = Mage::getSingleton('core/session')->getFPUser();
        $this->setTemplate('wao/singup/singEdit.phtml');
    }

    public function getImage() {
        //$uploader = new Varien_File_Uploader_Image();
        $imgId = $this->getRequest()->getParam('img');
        //$item = Mage::getModel('forpix/images')->load($imgId)->getFileNames();
        $uploader = new Varien_File_Uploader_Image($item);
        echo $item; 
    }

}

