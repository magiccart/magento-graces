<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: Magiccart<team.magiccart@gmail.com>
 * @@Create Date: 2014-08-07 22:10:30
 * @@Modify Date: 2016-01-13 17:02:23
 * @@Function:
 */

class Magiccart_Magicmenu_Model_System_Config_Category
{

    protected  $_options = array();
    
    public function toOptionArray() {
        if(!$this->_options){
            $categories = Mage::getModel('adminhtml/system_config_source_category')->toOptionArray();
            $options = array();
            foreach ($categories as $category) {
                if($category['value']) {
                    $rootOption = array('label' => $category['label']);
                    $_categories = Mage::getModel('catalog/category')->getCategories($category['value']);
                    $childOptions = array();
                    foreach ($_categories as $_category) {
                        $childOptions[] = array(
                            'label' => $_category->getName(),
                            'value' => $_category->getId()
                        );
                    }
                    $rootOption['value'] = $childOptions;
                    $options[] = $rootOption;
                }
            }
            $this->_options = $options;      
        }

        return $this->_options;
    }
 
}
