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
        $this->renderLayout();
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
        $this->loadLayout();
        $this->renderLayout();
    }

}