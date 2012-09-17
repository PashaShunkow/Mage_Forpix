<?php

class Wao_Singup_IndexController extends Mage_Core_Controller_Front_Action {

    function indexAction() {
        $param = $this->getRequest()->getParam('unlog');
        if (isset($param) && $param == 1) {
            Mage::getSingleton('core/session')->setFPUser('');
        }
        $session = Mage::getSingleton('core/session')->getFPUser();
        if (isset($session['login'])) {
            $url = Mage::getUrl('singup/index/account');
            $this->_redirectUrl($url);
        }
        $this->loadLayout();
        $this->renderLayout();
    }

    function registrationAction() {
        $session = Mage::getSingleton('core/session')->getFPUser();
        if (isset($session['login'])) {
            $url = Mage::getUrl('singup/index/account');
            $this->_redirectUrl($url);
        }
        $this->loadLayout();
        $this->renderLayout();
    }

    function accountAction() {
        $session = Mage::getSingleton('core/session')->getFPUser();
        if (!isset($session['login'])) {
            $url = Mage::getUrl('singup');
            $this->_redirectUrl($url);
        }


        $this->loadLayout();
        $session = Mage::getSingleton('core/session')->getFPUser();
        if (isset($session['last_img'])) {
            $block = $this->getLayout()->createBlock('Wao_Singup_Block_Inner');
            $this->getLayout()->getBlock('singAcc')->append($block);
        }
        $this->renderLayout();
        unset($session['last_img']);
        Mage::getSingleton('core/session')->setFPUser($session);
    }

    function uploaderAction() {
        $data = $this->getRequest()->getPost();
        if (!empty($data)) {
            $model = Mage::getModel('singup/uploader')->setData($data);
            $model->saveImage();
            $url = Mage::getUrl('singup');
            $this->_redirectUrl($url);
        } else {
            $url = Mage::getUrl('singup');
            $this->_redirectUrl($url);
        }
    }

    function editAction() {
        $data = $this->getRequest()->getPost();
        if (!empty($data)) {
            $model = Mage::getModel('singup/uploader')->setData($data);
            $model->editImageData($data);
        }
        if ($this->getRequest()->getParam('img') == null && $data['del'] == null) {
            $url = Mage::getUrl('singup');
            $this->_redirectUrl($url);
        }
        if ($data['del'] != null) {
            $model = Mage::getModel('singup/uploader');
            $model->delImg($data['del']);
            $url = Mage::getUrl('singup');
            $this->_redirectUrl($url);
        }

        $this->loadLayout();
        $this->renderLayout();
    }

}