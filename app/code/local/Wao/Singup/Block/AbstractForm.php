<?php

class Wao_Singup_Block_AbstractForm extends Mage_Core_Block_Template {

    protected $controll;
    protected $message;
    protected $session = array();
    protected $errors = array();
    protected $data = array();

    public function getFormData($key, $type) {
        if ($type == "session") {
            echo $this->session[$key];
        } else {
            echo $this->data[$key];
        }
    }

    public function getFormErros($key) {
        echo $this->errors[$key];
    }

    public function getDebug() {
        echo "<pre>" . print_r($this->controll, true) . "</pre>";
    }
}

?>
