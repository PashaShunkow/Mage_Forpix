<?php

class Wao_Singup_Block_Registr extends Wao_Singup_Block_AbstractForm {

    protected function _construct() {
        $this->setTemplate('wao/singup/singReg.phtml');
        $this->checkRequest();
    }

    public function checkRequest() {
        $this->data = $this->getRequest()->getPost();

        if (isset($this->data) && !empty($this->data)) {
            $collection = Mage::getModel('singup/singup')->getCollection();
            //Check data
            if (!Zend_Validate::is($this->data['login'], 'NotEmpty')) {
                $this->errors['login'] = "Поле не должно быть пустым";
            } else {
                foreach ($collection as $user) {
                    if ($user['login'] == $this->data['login']) {
                        $this->errors['login'] = "Пользователь с таким именем уже сувщевствует";
                    }
                }
            }
            if (!Zend_Validate::is($this->data['e_mail'], 'EmailAddress')) {
                $this->errors['e_mail'] = "Введеный е_маил не валидный";
            } else {
                foreach ($collection as $user) {
                    if ($user['e_mail'] == $this->data['e_mail']) {
                        $this->errors['e_mail'] = "Пользователь с таким E-mail уже сувщевствует";
                    }
                }
            }
            if (!Zend_Validate::is($this->data['pass'], 'NotEmpty')) {
                $this->errors['pass'] = "Поле не должно быть пустым";
            } else {
                if ($this->data['pass'] != $this->data['re_pass']) {
                    $this->errors['pass'] = "Веведенные пароли не одинаковы";
                }
            }
            //Add User
            if (empty($this->errors)) {
                $this->addUser();
            }
        }
    }

    private function addUser() {
        $collection = Mage::getModel('singup/singup');
        //setId - для редагування а не додавання нового
        $collection->addData(array('login' => $this->data['login'], 'pass' => $this->data['pass'],'e_mail' => $this->data['e_mail']))->save();
        $this->helper('singup/data')->sendTo('singup');
    }

}