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
class Netgo_Slider_Block_Adminhtml_Homeslider
    extends Mage_Adminhtml_Block_Widget_Grid_Container {
    /**
     * constructor
     * @access public
     * @return void
     * @author Vipin
     */
    public function __construct(){
        $this->_controller         = 'adminhtml_homeslider';
        $this->_blockGroup         = 'netgo_slider';
        parent::__construct();
        $this->_headerText         = Mage::helper('netgo_slider')->__('Homeslider');
        $this->_updateButton('add', 'label', Mage::helper('netgo_slider')->__('Add Homeslider'));

    }
}
