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
class Netgo_Slider_Block_Adminhtml_Homeslider_Helper_Image
    extends Varien_Data_Form_Element_Image {
    /**
     * get the url of the image
     * @access protected
     * @return string
     * @author Vipin
     */
    protected function _getUrl(){
        $url = false;
        if ($this->getValue()) {
            $url = Mage::helper('netgo_slider/homeslider_image')->getImageBaseUrl().$this->getValue();
        }
        return $url;
    }
}
