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
class Netgo_Slider_Block_Homeslider_View
    extends Mage_Core_Block_Template {
    /**
     * get the current homeslider
     * @access public
     * @return mixed (Netgo_Slider_Model_Homeslider|null)
     * @author Vipin
     */
    public function getCurrentHomeslider(){
        return Mage::registry('current_homeslider');
    }
}
