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
class Netgo_Slider_Block_Homeslider_List
    extends Mage_Core_Block_Template {
    /**
     * initialize
     * @access public
     * @author Vipin
     */
     public function __construct(){
        parent::__construct();
         $homesliders = Mage::getResourceModel('netgo_slider/homeslider_collection')
                         ->addStoreFilter(Mage::app()->getStore())
                         ->addFieldToFilter('status', 1);
        $homesliders->setOrder('caption', 'asc');
        $this->setHomesliders($homesliders);
    }
    /**
     * prepare the layout
     * @access protected
     * @return Netgo_Slider_Block_Homeslider_List
     * @author Vipin
     */
    protected function _prepareLayout(){
        parent::_prepareLayout();
        $pager = $this->getLayout()->createBlock('page/html_pager', 'netgo_slider.homeslider.html.pager')
            ->setCollection($this->getHomesliders());
        $this->setChild('pager', $pager);
        $this->getHomesliders()->load();
        return $this;
    }
    /**
     * get the pager html
     * @access public
     * @return string
     * @author Vipin
     */
    public function getPagerHtml(){
        return $this->getChildHtml('pager');
    }
}
