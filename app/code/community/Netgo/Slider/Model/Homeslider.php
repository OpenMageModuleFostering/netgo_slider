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
class Netgo_Slider_Model_Homeslider
    extends Mage_Core_Model_Abstract {
    /**
     * Entity code.
     * Can be used as part of method name for entity processing
     */
    const ENTITY    = 'netgo_slider_homeslider';
    const CACHE_TAG = 'netgo_slider_homeslider';
    /**
     * Prefix of model events names
     * @var string
     */
    protected $_eventPrefix = 'netgo_slider_homeslider';

    /**
     * Parameter name in event
     * @var string
     */
    protected $_eventObject = 'homeslider';
    /**
     * constructor
     * @access public
     * @return void
     * @author Vipin
     */
    public function _construct(){
        parent::_construct();
        $this->_init('netgo_slider/homeslider');
    }
    /**
     * before save homeslider
     * @access protected
     * @return Netgo_Slider_Model_Homeslider
     * @author Vipin
     */
    protected function _beforeSave(){
        parent::_beforeSave();
        $now = Mage::getSingleton('core/date')->gmtDate();
        if ($this->isObjectNew()){
            $this->setCreatedAt($now);
        }
        $this->setUpdatedAt($now);
        return $this;
    }
    /**
     * get the url to the homeslider details page
     * @access public
     * @return string
     * @author Vipin
     */
    public function getHomesliderUrl(){
        if ($this->getUrlKey()){
            $urlKey = '';
            if ($prefix = Mage::getStoreConfig('netgo_slider/homeslider/url_prefix')){
                $urlKey .= $prefix.'/';
            }
            $urlKey .= $this->getUrlKey();
            if ($suffix = Mage::getStoreConfig('netgo_slider/homeslider/url_suffix')){
                $urlKey .= '.'.$suffix;
            }
            return Mage::getUrl('', array('_direct'=>$urlKey));
        }
        return Mage::getUrl('netgo_slider/homeslider/view', array('id'=>$this->getId()));
    }
    /**
     * check URL key
     * @access public
     * @param string $urlKey
     * @param bool $active
     * @return mixed
     * @author Vipin
     */
    public function checkUrlKey($urlKey, $active = true){
        return $this->_getResource()->checkUrlKey($urlKey, $active);
    }

    /**
     * save homeslider relation
     * @access public
     * @return Netgo_Slider_Model_Homeslider
     * @author Vipin
     */
    protected function _afterSave() {
        return parent::_afterSave();
    }
    /**
     * get default values
     * @access public
     * @return array
     * @author Vipin
     */
    public function getDefaultValues() {
        $values = array();
        $values['status'] = 1;
        return $values;
    }
	
  public function toOptionArray()
   {
    return array(
      array('value' => 0, 'label' =>'None'),
      array('value' => 1, 'label' => 'Fade'),
      array('value' => 2, 'label' =>'Slide Top'),
      array('value' => 3, 'label' =>'Slide Right'),
      array('value' => 4, 'label' =>'Slide Bottom'),
      array('value' => 5, 'label' =>'Slide Left'),
      array('value' => 6, 'label' =>'Carousel Right'),
     // and so on...
    );
  }
 
}
