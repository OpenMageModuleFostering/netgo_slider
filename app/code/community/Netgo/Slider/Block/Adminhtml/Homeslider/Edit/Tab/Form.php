<?php
/***************************************
 *** Home Background Slider Extension ***
 ***************************************
 *
 * @copyright   Copyright (c) 2015
 * @company     NetAttingo Technologies
 * @package     Netgo_Slider
 * @author 		Vipin
 * @dev			77vips@gmail.com
 *
 */
class Netgo_Slider_Block_Adminhtml_Homeslider_Edit_Tab_Form
    extends Mage_Adminhtml_Block_Widget_Form {
    /**
     * prepare the form
     * @access protected
     * @return Netgo_Slider_Block_Adminhtml_Homeslider_Edit_Tab_Form
     * @author Vipin
     */
    protected function _prepareForm(){
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('homeslider_');
        $form->setFieldNameSuffix('homeslider');
        $this->setForm($form);
        $fieldset = $form->addFieldset('homeslider_form', array('legend'=>Mage::helper('netgo_slider')->__('Homeslider')));
        $fieldset->addType('image', Mage::getConfig()->getBlockClassName('netgo_slider/adminhtml_homeslider_helper_image'));

        $fieldset->addField('caption', 'textarea', array(
            'label' => Mage::helper('netgo_slider')->__('Caption'),
            'name'  => 'caption',
            'note'	=> $this->__('Caption of the slider Image'),
            'required'  => false,
            'class' => 'required-entry',

        ));

        $fieldset->addField('image', 'image', array(
            'label' => Mage::helper('netgo_slider')->__('Image'),
            'name'  => 'image',

        ));

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('netgo_slider')->__('Status'),
            'name'  => 'status',
            'values'=> array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('netgo_slider')->__('Enabled'),
                ),
                array(
                    'value' => 0,
                    'label' => Mage::helper('netgo_slider')->__('Disabled'),
                ),
            ),
        ));
        if (Mage::app()->isSingleStoreMode()){
            $fieldset->addField('store_id', 'hidden', array(
                'name'      => 'stores[]',
                'value'     => Mage::app()->getStore(true)->getId()
            ));
            Mage::registry('current_homeslider')->setStoreId(Mage::app()->getStore(true)->getId());
        }
        $formValues = Mage::registry('current_homeslider')->getDefaultValues();
        if (!is_array($formValues)){
            $formValues = array();
        }
        if (Mage::getSingleton('adminhtml/session')->getHomesliderData()){
            $formValues = array_merge($formValues, Mage::getSingleton('adminhtml/session')->getHomesliderData());
            Mage::getSingleton('adminhtml/session')->setHomesliderData(null);
        }
        elseif (Mage::registry('current_homeslider')){
            $formValues = array_merge($formValues, Mage::registry('current_homeslider')->getData());
        }
        $form->setValues($formValues);
        return parent::_prepareForm();
    }
}
