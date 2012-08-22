<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 *
 * @author shev
 */
class Wao_Forpix_IndexController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {
        $this->loadLayout()
                ->renderLayout();
    }

    public function imageAction() {
        $quote_id = (int) $this->getRequest()->getParam('id');
        
        if (!$quote_id) {
            $this->_forward('noRoute');
            return;
        }
        
        $this->loadLayout();
        $this->getLayout()
                ->getBlock('images.item')
                ->setImagesId($quote_id);
        $this->renderLayout();
        
    }

}