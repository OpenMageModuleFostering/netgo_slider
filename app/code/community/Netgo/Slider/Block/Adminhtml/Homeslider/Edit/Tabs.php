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
class Netgo_Slider_Block_Adminhtml_Homeslider_Edit_Tabs
    extends Mage_Adminhtml_Block_Widget_Tabs {
    /**
     * Initialize Tabs
     * @access public
     * @author Vipin
     */
    public function __construct() {
        parent::__construct();
        $this->setId('homeslider_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('netgo_slider')->__('Homeslider'));
    }
    /**
     * before render html
     * @access protected
     * @return Netgo_Slider_Block_Adminhtml_Homeslider_Edit_Tabs
     * @author Vipin
     */
    protected function _beforeToHtml(){
        $this->addTab('form_homeslider', array(
            'label'        => Mage::helper('netgo_slider')->__('Homeslider'),
            'title'        => Mage::helper('netgo_slider')->__('Homeslider'),
            'content'     => $this->getLayout()->createBlock('netgo_slider/adminhtml_homeslider_edit_tab_form')->toHtml(),
        ));
        if (!Mage::app()->isSingleStoreMode()){
            $this->addTab('form_store_homeslider', array(
                'label'        => Mage::helper('netgo_slider')->__('Store views'),
                'title'        => Mage::helper('netgo_slider')->__('Store views'),
                'content'     => $this->getLayout()->createBlock('netgo_slider/adminhtml_homeslider_edit_tab_stores')->toHtml(),
            ));
        }
        return parent::_beforeToHtml();
    }
    /**
     * Retrieve homeslider entity
     * @access public
     * @return Netgo_Slider_Model_Homeslider
     * @author Vipin
     */
    public function getHomeslider(){
        return Mage::registry('current_homeslider');
    }
}
