<?php
/**
 * Magiccart 
 * @category  Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license   http://www.magiccart.net/license-agreement.html
 * @Author: Magiccart<team.magiccart@gmail.com>
 * @@Create Date: 2014-09-10 10:21:05
 * @@Modify Date: 2015-07-24 14:39:19
 * @@Function:
 */
?>
<?php
class Magiccart_Magicproduct_Block_Adminhtml_Manage_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$model = Mage::registry('magicproduct_data');	
		
		// if($model->getStores())
		// {		
		// 	//$_model->setPageId(Mage::helper('core')->jsonDecode($_model->getPageId()));
		// 	$model->setStores(explode(',',$model->getStores()));
		// }

		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset('magicproduct_form', array('legend'=>Mage::helper('magicproduct')->__('General Information')));

		$fieldset->addField('countdown', 'date', array(
		    'name'               => 'countdown',
		    'label'              => Mage::helper('adminhtml')->__('Countdown To Date'),
		    'after_element_html' => '<p class="nm"><small>Countdown To Date</small></p>',
		    'image'              => $this->getSkinUrl('images/grid-cal.gif'),
		    'format'             => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT) ,
		    'value'              => date( Mage::app()->getLocale()->getDateStrFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT), strtotime('next weekday') )
		));
		
		$fieldset->addField('title', 'text', array(
			'label'     => Mage::helper('adminhtml')->__('Title'),
			'class'     => 'required-entry',
			'required'  => true,
			'name'      => 'title',
		));

        $fieldset->addField('identifier', 'text', array(
            'name'      => 'identifier',
            'label'     => Mage::helper('adminhtml')->__('Identifier'),
            'title'     => Mage::helper('adminhtml')->__('Identifier'),
            'required'  => true,
            'class'     => 'validate-xml-identifier',
            'after_element_html' => '<p class="nm"><small>For example: slide-home_1, slide-home_2, slide-left,</small></p>'
        ));

		$fieldset->addField('types', 'multiselect', array(
			'name'      => 'types[]',
			'label'     => Mage::helper('adminhtml')->__('Product Collection'),
			'title'     => Mage::helper('adminhtml')->__('Product Collection'),
			'required'  => true,			
			'values'    => Mage::getSingleton('magicproduct/system_config_type')->toOptionArray(),
			// 'value'     => $model->getStores()
			//'value'     => array('0'=>'1','1'=>'2'),	
		));

		$fieldset->addField('active', 'select', array(
			'name'      => 'active',
			'label'     => Mage::helper('adminhtml')->__('Tab Active'),
			'title'     => Mage::helper('adminhtml')->__('Tab Active'),
			'required'  => true,			
			'values'    => Mage::getSingleton('magicproduct/system_config_type')->toOptionArray(),
		));

        $fieldset->addField('limit', 'text', array(
            'name'      => 'limit',
            'label'     => Mage::helper('adminhtml')->__('Limit'),
            'title'     => Mage::helper('adminhtml')->__('Limit'),
            'value'		=> 10,
            'required'  => true,
            'class'     => 'validate-greater-than-zero',
        )); 
		
		$fieldset->addField('status', 'select', array(
			'label'     => Mage::helper('adminhtml')->__('Status'),
			'name'      => 'status',
			'values'    => array(
				array(
				'value'     => 1,
				'label'     => Mage::helper('adminhtml')->__('Enabled'),
				),
				array(
				'value'     => 2,
				'label'     => Mage::helper('adminhtml')->__('Disabled'),
				),
			),
		));
		
		// $fieldset->addField('advanced_settings', 'textarea', array(
		// 	'label'     => Mage::helper('adminhtml')->__('Advanced Settings'),
		// 	'required'  => false,
		// 	'name'      => 'advanced_settings',
		// 	'note'   	=> "Default : {numbers_align: 'right',animation:'fade',interval: 1000,dots: true,navigation: false}"
		// )); 
		
		if (Mage::getSingleton('adminhtml/session')->getMagicproductData())
		{
			$form->setValues(Mage::getSingleton('adminhtml/session')->getMagicproductData());
			Mage::getSingleton('adminhtml/session')->setMagicproductData(null);
		} elseif ( Mage::registry('magicproduct_data') ) {
            $data = Mage::registry('magicproduct_data')->getData();
            if($data) $form->setValues($data);
		}
		return parent::_prepareForm();
	}
}
