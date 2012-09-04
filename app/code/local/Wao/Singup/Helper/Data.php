<?php

class Wao_Singup_Helper_Data extends Mage_Core_Helper_Abstract {

    public function getPostUrl($urlPart, $params) {
        echo Mage::getUrl($urlPart, $params);
    }

    public function sendTo($url)
    {
        $url = Mage::getUrl($url);
        Mage::app()->getFrontController()->getResponse()->setRedirect($url);
    }
}
