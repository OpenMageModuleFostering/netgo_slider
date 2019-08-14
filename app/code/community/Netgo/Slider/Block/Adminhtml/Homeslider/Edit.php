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
class Netgo_Slider_Block_Adminhtml_Homeslider_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container {
    /**
     * constructor
     * @access public
     * @return void
     * @author Vipin
     */
    public function __construct(){
        parent::__construct();
        $this->_blockGroup = 'netgo_slider';
        $this->_controller = 'adminhtml_homeslider';
        $this->_updateButton('save', 'label', Mage::helper('netgo_slider')->__('Save Homeslider'));
        $this->_updateButton('delete', 'label', Mage::helper('netgo_slider')->__('Delete Homeslider'));
        $this->_addButton('saveandcontinue', array(
            'label'        => Mage::helper('netgo_slider')->__('Save And Continue Edit'),
            'onclick'    => 'saveAndContinueEdit()',
            'class'        => 'save',
        ), -100);
        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }
    /**
     * get the edit form header
     * @access public
     * @return string
     * @author Vipin
     */
    public function getHeaderText(){
        if( Mage::registry('current_homeslider') && Mage::registry('current_homeslider')->getId() ) {
            return Mage::helper('netgo_slider')->__("Edit Homeslider '%s'", $this->escapeHtml(Mage::registry('current_homeslider')->getCaption()));
        }
        else {
            return Mage::helper('netgo_slider')->__('Add Homeslider');
        }
    }
}
