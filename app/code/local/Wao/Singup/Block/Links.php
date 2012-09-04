<?php

class Wao_Singup_Block_Links extends Wao_Singup_Block_AbstractForm {

    protected function _construct() {
        $this->session = Mage::getSingleton('core/session')->getFPUser();
        $this->checkRequest();
        $this->setTemplate('wao/singup/singLinks.phtml');
    }

    private function checkRequest() {
        $this->data = $this->getRequest()->getPost();

        if (isset($this->data) && !empty($this->data)) {
            if (!Zend_Validate::is($this->data['login'], 'NotEmpty')) {
                $this->errors['login'] = "Поле не должно быть пустым";
            }
            if (!Zend_Validate::is($this->data['pass'], 'NotEmpty')) {
                $this->errors['pass'] = "Поле не должно быть пустым";
            }
        }

        if (empty($this->errors)) {
            $collection = Mage::getModel('singup/singup')->getCollection();
            foreach ($collection as $user) {
                if ($user->getPass() == $this->data['pass'] && $user->getLogin() == $this->data['login']) {
                    $this->data['id'] = $user->getId();
                    Mage::getSingleton('core/session')->setFPUser($this->data);
                    $this->session = Mage::getSingleton('core/session')->getFPUser();
                    $this->helper('singup/data')->sendTo('singup/index/account');
                } else {
                    $this->message = "Сочетание логин пароль не найдено.";
                }
            }
        }
    }

}

?>
