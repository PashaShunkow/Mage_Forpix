<?php

class Wao_Singup_Block_Account extends Wao_Singup_Block_AbstractForm {

    protected function _construct() {
        $this->setTemplate('wao/singup/singAccount.phtml');
        $this->session = Mage::getSingleton('core/session')->getFPUser();
    }

    public function getImages() {
        if (($this->getRequest()->getParam('img') != '')) {
            $data = Mage::getModel('forpix/images')->getCollection()->addFieldToFilter('id', $this->getRequest()->getParam('img'));
        } else {
            $data = Mage::getModel('forpix/images')->getCollection()->addFieldToFilter('user_login', $this->session['login']);
        }
        return $data;
    }

    public function getBigImg($imgName) {
        $fullImgPath = Mage::getBaseUrl() . "/media/forpix/" . $imgName;
        return $fullImgPath;
    }

    public function getPrevImg($imgPath, $type) {
        if ($imgPath == "lastImg") {
            $user_data = Mage::getSingleton('core/session')->getFPUser();
            $imgPath = $user_data['last_img'];
        }
        if (is_file(Mage::getBaseDir() . "/media/forpix/" . $imgPath)) {
            $prev = new Varien_Image(Mage::getBaseDir() . "/media/forpix/" . $imgPath);
            switch ($type) {
                case "mini":
                    $prev->resize(150, 100);
                    $thumbPath = "/media/forpix/thumbs/";
                    break;
                case "middle":
                    $prev->resize(300, 200);
                    $thumbPath = "/media/forpix/thumbs_middle/";
                    break;
                case "big":
                    $prev->resize(600, 400);
                    $thumbPath = "/media/forpix/thumbs_big/";
                    break;
                case "full":
                    $thumbPath = "media/forpix/";
                    return Mage::getBaseUrl() . $thumbPath . $imgPath;
                    break;
                default :
                    $prev->resize(150, 100);
                    $thumbPath = "/media/forpix/thumbs/";
            }
            if (!is_dir(Mage::getBaseDir() . $thumbPath)) {
                mkdir(Mage::getBaseDir() . $thumbPath);
            }

            $imgName = explode("/", $imgPath);
            $imgName = $imgName[count($imgName) - 1];
            $imgName = substr($imgName, 0, strlen($imgName) - 4);
            if (!is_file(Mage::getBaseDir() . $thumbPath . "thumb_" . $imgName . ".jpg")) {
                $prev->save(Mage::getBaseDir() . $thumbPath, "thumb_" . $imgName . ".jpg");
            }
            return Mage::getBaseUrl() . $thumbPath . "thumb_" . $imgName . ".jpg";
        }
    }

}