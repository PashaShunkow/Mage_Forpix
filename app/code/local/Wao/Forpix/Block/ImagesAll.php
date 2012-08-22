<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Content
 *
 * @author shev
 */
class Wao_Forpix_Block_ImagesAll extends Mage_Core_Block_Template {

    protected function _construct() {
        
        $this->setTemplate('wao/forpix/main.phtml');
    }

    public function getRowUrl(Wao_Forpix_Model_Images $quote) {
        return $this->getUrl('*/*/image', array(
                    'id' => $quote->getId()
                ));
    }

    public function getCollection() {
        return Mage::getModel('forpix/images')->getCollection();
    }
}
