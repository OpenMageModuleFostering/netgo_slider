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
class Netgo_Slider_Model_Preparelayout
    extends Mage_Core_Model_Abstract {
		
    public function prepareLayoutBefore(Varien_Event_Observer $observer)
   {
	     if (Mage::helper('netgo_slider/homeslider')->isEnableSlider()) 
		 {
				$block = $observer->getEvent()->getBlock(); 
				if (Mage::helper('netgo_slider/homeslider')->isEnableJQuery()) 
				{ 
					/* @var $block Mage_Page_Block_Html_Head */ 
					if ("head" == $block->getNameInLayout()) {  
					// echo '<pre>';print_r(Mage::helper('netgo_slider/homeslider')->getFiles());die;
					foreach (Mage::helper('netgo_slider/homeslider')->getFiles() as   $file) {
						$block->addJs(Mage::helper('netgo_slider/homeslider')->getJQueryPath($file)); 
						} 
					}
				} 
				//add other javascript files
				if ("head" == $block->getNameInLayout()) {  
					// echo '<pre>';print_r(Mage::helper('netgo_slider/homeslider')->getFiles());die;
					foreach (Mage::helper('netgo_slider/homeslider')->getSliderFiles() as   $file) {
						$block->addJs(Mage::helper('netgo_slider/homeslider')->getJQueryPath($file)); 
					} 
				}
	}
       return $this;
   }
	
 
}
