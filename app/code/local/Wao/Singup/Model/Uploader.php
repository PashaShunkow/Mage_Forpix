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
        return "media/forpix/";
    }

    public function setImage($image) {
        if ($image instanceof Varien_File_Uploader) {
            $session = Mage::getSingleton('core/session')->getFPUser();
            if ($this->getData('name') != '') {

                $fileName = $image->getCorrectFileName($this->transName($this->getData('name')));

                $fileName = $image->getCorrectFileName($this->transName($this->getData('name')));

                $image->save($this->getImagePath(), $fileName . "." . $image->getFileExtension());
                $fullFileName = $fileName . "." . $image->getFileExtension();
            } else {
                $image->save($this->getImagePath());
                $fileName = $image->getUploadedFileName();
                $fullFileName = $fileName;
            }
            $keyWords = $this->getData('key_words');
            //setId - для редагування а не додавання нового
            $this->addData(array('file_names' => $fullFileName,
                        'tegs' => $keyWords,
                        'kategoriya' => $this->getData('category'),
                        'user_login' => $session['login'],
                        'data_add' => date('Y-m-d'),
                        'imgorfoto' => $this->getData('img_type')))
                    ->save();
            $session = Mage::getSingleton('core/session')->getFPUser();
            $session['last_img'] = $fullFileName;
            Mage::getSingleton('core/session')->setFPUser($session);
        }
        $this->setData('image', $image);
        return $this;
    }

    public function editImageData($data) {
        $correct_name = Varien_File_Uploader::getCorrectFileName($this->transName($data['file_name']));
        $new_name = $correct_name . '.' . $data['ext'];
        if ($new_name != $data['old_name']) {
            $this->setFileNames($new_name);
            $this->renameFile($data, $new_name);
        }
        $this->setTegs($data['tegs']);
        $this->setId($data['id'])->save();
    }

    public function delImg($id) {
        $this->load($id);

        $imgName = explode("/", $this->getFileNames());
        $imgName = $imgName[count($imgName) - 1];
        $imgName = substr($imgName, 0, strlen($imgName) - 4);

        unlink(Mage::getBaseDir() . "/media/forpix/" . $this->getFileNames());
        unlink(Mage::getBaseDir() . "/media/forpix/thumbs/" . "thumb_" . $imgName . ".jpg");
        unlink(Mage::getBaseDir() . "/media/forpix/thumbs_middle/" . "thumb_" . $imgName . ".jpg");
        $this->setId($id)->delete();
    }

    protected function renameFile($data, $new_name) {
        rename(Mage::getBaseDir() . "/media/forpix/" . $data['old_name'], Mage::getBaseDir() . "/media/forpix/" . $new_name);
        unlink(Mage::getBaseDir() . "/media/forpix/thumbs/" . "thumb_" . $data['old_name']);
    }

    protected function transName($st) {
        $converter = array(
            'а' => 'a', 'б' => 'b', 'в' => 'v',
            'г' => 'g', 'д' => 'd', 'е' => 'e',
            'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
            'и' => 'i', 'й' => 'y', 'к' => 'k',
            'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r',
            'с' => 's', 'т' => 't', 'у' => 'u',
            'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
            'ь' => "'", 'ы' => 'y', 'ъ' => "'",
            'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
            'А' => 'A', 'Б' => 'B', 'В' => 'V',
            'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
            'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
            'И' => 'I', 'Й' => 'Y', 'К' => 'K',
            'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R',
            'С' => 'S', 'Т' => 'T', 'У' => 'U',
            'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
            'Ь' => "'", 'Ы' => 'Y', 'Ъ' => "'",
            'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
            'і' => 'i', 'ї' => 'i', 'є' => 'e',
            'І' => 'І', 'Ї' => 'І', 'Є' => 'E', ' ' => '_'
        );
        $st = strtr($st, $converter);
        //$st = mysql_real_escape_string($st);
        // die($st);
        return $st;
    }

}
