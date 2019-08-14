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
class Netgo_Slider_Helper_Homeslider
    extends Mage_Core_Helper_Abstract {
    /**
     * get the url to the homeslider list page
     * @access public
     * @return string
     * @author Vipin
     */
    public function getHomeslidersUrl(){
        if ($listKey = Mage::getStoreConfig('netgo_slider/homeslider/url_rewrite_list')) {
            return Mage::getUrl('', array('_direct'=>$listKey));
        }
        return Mage::getUrl('netgo_slider/homeslider/index');
    }
    /**
     * check if breadcrumbs can be used
     * @access public
     * @return bool
     * @author Vipin
     */
    public function getUseBreadcrumbs(){
        return Mage::getStoreConfigFlag('netgo_slider/homeslider/breadcrumbs');
    }
	
	protected $jsdir = 'netgobackslider/';
 
   /**
    * List files for include.
    *
    * @var array
    */
   protected $_files = array(
       'jquery-1.10.2.min.js',
       'noconflict.js',
   );
   protected $_sliderfiles = array(
       'jquery.easing.min.js',
       'supersized.3.2.7.min.js',
       'supersized.shutter.min.js',
   );
   
   
   public function getFiles(){ 
	   return  $this->_files;
   } 
   public function getSliderFiles(){ 
	   return  $this->_sliderfiles;
   }
   
   
      public function getJQueryPath($filename){ 
	    return $this->jsdir.$filename; 
   }
   
     public function isEnableSlider(){ 
	   $enableSlider = Mage::getStoreConfig('netgo_slider/homeslider/enableslider');
	   if($enableSlider==1){
		   return true;
	   }else{ 
		   return false;
	   }
   }
   
   public function isEnableJQuery(){ 
	   $enablejQuery = Mage::getStoreConfig('netgo_slider/homeslider/enablejquery');
	   if($enablejQuery==1){
		   return true;
	   }else{ 
		   return false;
	   }
   }
}
