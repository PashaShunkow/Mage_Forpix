<?php

class Wao_Singup_Model_Uploader extends Mage_Core_Model_Abstract {

    protected $pathImg = "forpix";
    protected $data = array();

    protected function _construct() {
        $this->_init('forpix/images');
    }

    public function saveImage() {
        if ($this->getData('image/delete')) {
            $this->unsImage();
        }
        try {
            $uploader = new Varien_File_Uploader('image');
            $uploader->setAllowedExtensions(array('jpg', 'png'));
            $uploader->setAllowRenameFiles(true);
            $this->setImage($uploader);
        } catch (Exception $e) {
            //
        }
    }

    public function getImagePath() {
        return Mage::getBaseDir('media') . DS . $this->pathImg . DS;
    }

    public function getImageUrl() {
        return Mage::getBaseUrl('media') . "forpix/";
    }

    public function setImage($image) {
        if ($image instanceof Varien_File_Uploader) {
            echo "<pre>" . print_r($image, true) . "</pre>";
            $session = Mage::getSingleton('core/session')->getFPUser();
            if ($this->getData('name') != '') {
                $fileName = $image->getCorrectFileName($this->getData('name'));
                $image->save($this->getImagePath(), $fileName . "." . $image->getFileExtension());
                $fullFileName = $fileName . "." . $image->getFileExtension();
            } else {
                $image->save($this->getImagePath());
                $fileName = $image->getUploadedFileName();
                $fullFileName = $fileName;
            }
            $keyWords = $this->getData('key_words');
            //setId - для редагування а не додавання нового
            $this->addData(array('file_names' => $this->getImageUrl() . $fullFileName,
                        'tegs' => $keyWords,
                        'kategoriya' => $this->getData('category'),
                        'user_login' => $session['login'],
                        'data_add' => date('Y-m-d'),
                        'imgorfoto' => $this->getData('img_type')))
                    ->save();
        }
        $this->setData('image', $image);
        return $this;
    }

}
