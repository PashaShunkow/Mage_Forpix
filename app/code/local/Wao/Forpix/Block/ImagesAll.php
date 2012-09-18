<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Content
 *
 * @author shev
 */
class Wao_Forpix_Block_ImagesAll extends Mage_Core_Block_Template {

    protected function _construct() {

        $this->setTemplate('wao/forpix/main.phtml');
    }

    public function getRowUrl(Wao_Forpix_Model_Images $quote) {
        return $this->getUrl('*/*/image', array(
                    'id' => $quote->getId()
                ));
    }

    public function getCollection() {
        return Mage::getModel('forpix/images')->getCollection();
    }

    /**
     * 
     * @return type
     */
    public function getSortImg() {
        $read = Mage::getSingleton('core/resource')->getConnection('core_read');

        $thumbs = $this->getRequest()->getParam('thumbs');
        if (isset($thumbs) && !empty($thumbs) && is_numeric($thumbs) && $thumbs > 0 && ($thumbs == 12 or $thumbs == 24 or $thumbs == 36)) {
            $itemsperpage = $thumbs;
        } else {
            $itemsperpage = 12;
        }


        $sort = $this->getRequest()->getParam('sort');
        switch ($sort) {
            case 1:
                $sort = 'top';
                break;

            case 2:
                $sort = 'download';
                break;

            case 3:
                $sort = 'up';
                break;

            default:
                $sort = 'id';
                break;
        }


        $katN = $this->getRequest()->getParam('kat');
        if (isset($katN) && !empty($katN) && is_numeric($katN) && $katN > 1) {
            $kategoriya_sort = "AND `category` = " . $katN . "";
        } else {
            $kategoriya_sort = "";
        }

        $sizewhN = $this->getRequest()->getParam('sizewh');
        if (isset($sizewhN) && !empty($sizewhN) && is_numeric($sizewhN) && $sizewhN > 0) {
            $sizewh = Mage::helper('forpix')->sizewh($sizewhN);
            $sizewh_sort = "AND `width` = " . $sizewh['w'] . " AND `hight` = " . $sizewh['h'] . "";
        } else {
            $sizewh_sort = "";
        }

        $textSearchN = $this->getRequest()->getParam('textSearch');
        if (isset($textSearchN) && !empty($textSearchN) && strlen($textSearchN) > 0) {
            $textSearch = mysql_escape_string($textSearchN);
            $search = "AND `tegs` LIKE '%" . $textSearch . "%'";
        } else {
            $search = "";
        }

        $pageN = $this->getRequest()->getParam('page');
        if (isset($pageN) && !empty($pageN) && is_numeric($pageN) && $pageN > 1) {
            $page = ($sort * $pageN) - $sort;
        } else {
            $page = 0;
        }

        $imgorfoto_sort = $this->imgorfoto($this->getRequest()->getParam('imgorfoto'));


        $id = $this->getRequest()->getParam('id');
        if (isset($id) && !empty($id) && is_numeric($id) && $id > 1) {
            $search = 'AND s.id =' . $id;
        }


        $color = $this->getRequest()->getParam('c');
        if (isset($color) && strlen($color) == 6) {
            $query = "SELECT SQL_CALC_FOUND_ROWS s.id, s.width, s.hight, s.description, s.data_add, s.file_names, s.names, c.name_dir, c.dir_id, s.download, s.top, s.colors,    
                        SUBSTRING(
                         s.colors,
                          LOCATE('" . $color . ":', s.colors) + 7,
                             4
                            ) AS proc
                     FROM fp_images_file s 
                         INNER JOIN fp_gallery_dir c ON s.category = c.dir_id 
                     WHERE `moderation` = 0 AND s.colors LIKE '%" . $color . "%' " . $kategoriya_sort . "  " . $imgorfoto_sort . " " . $sizewh_sort . " 
                    ORDER BY ROUND(proc, 2) DESC
                    LIMIT " . $page . ", " . $itemsperpage . "";
        } else {
            $query = "SELECT SQL_CALC_FOUND_ROWS  s.id, s.width, s.hight, s.description, s.data_add, s.file_names, s.name, c.name_dir, c.dir_id, s.download, s.up, s.top   
    FROM fp_images_file s 
    INNER JOIN fp_gallery_dir c ON s.category = c.dir_id 
    WHERE `moderation` = 0 " . $search . " " . $kategoriya_sort . "  " . $imgorfoto_sort . " " . $sizewh_sort . "
    ORDER BY `s`.`" . $sort . "` DESC 
    LIMIT " . $page . ", " . $itemsperpage . "";
        }






        $results = $read->fetchAll($query);

        $rows = $read->fetchAll("SELECT FOUND_ROWS() as `rows`");



        return array(
            'result' => $results,
            'rows' => $rows
        );
    }

    public function imgorfoto($imgorfoto_s) {

        if (isset($imgorfoto_s) && !empty($imgorfoto_s) && strlen($imgorfoto_s) == 7) {

            $Array = explode(",", $imgorfoto_s);


            $imgorfoto = '';
            if ($Array[0] == 0) {

                $imgorfoto .= " AND s.imgorfoto != 'img'";
            }
            if ($Array[1] == 0) {

                $imgorfoto .= " AND s.imgorfoto != 'foto'";
            }
            if ($Array[2] == 0) {

                $imgorfoto .= " AND s.imgorfoto != 'anime'";
            }
            if ($Array[3] == 0) {

                $imgorfoto .= " AND s.imgorfoto != 'age'";
            } else {

                $session = Mage::getSingleton('core/session')->getFPUser();
                if (isset($session['login'])) {
                    $imgorfoto .= " AND s.imgorfoto != 'age'";
                }
            }
            return($imgorfoto);
        } else {
            return(" AND s.imgorfoto != 'age'");
        }
    }

}
