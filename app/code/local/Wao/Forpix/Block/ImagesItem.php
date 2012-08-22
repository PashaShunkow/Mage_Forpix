<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImagesItem
 *
 * @author shev
 */
class Wao_Forpix_Block_ImagesItem extends Mage_Core_Block_Template {

    protected function _construct() {
        $this->setTemplate('wao/forpix/imagesItem.phtml');
    }

    public function getImages() {
        return Mage::getModel('forpix/images')->load($this->getImagesId());
    }

}

?>
