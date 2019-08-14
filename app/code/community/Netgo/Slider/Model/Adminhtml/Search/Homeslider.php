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
class Netgo_Slider_Model_Adminhtml_Search_Homeslider
    extends Varien_Object {
    /**
     * Load search results
     * @access public
     * @return Netgo_Slider_Model_Adminhtml_Search_Homeslider
     * @author Vipin
     */
    public function load(){
        $arr = array();
        if (!$this->hasStart() || !$this->hasLimit() || !$this->hasQuery()) {
            $this->setResults($arr);
            return $this;
        }
        $collection = Mage::getResourceModel('netgo_slider/homeslider_collection')
            ->addFieldToFilter('caption', array('like' => $this->getQuery().'%'))
            ->setCurPage($this->getStart())
            ->setPageSize($this->getLimit())
            ->load();
        foreach ($collection->getItems() as $homeslider) {
            $arr[] = array(
                'id'=> 'homeslider/1/'.$homeslider->getId(),
                'type'  => Mage::helper('netgo_slider')->__('Homeslider'),
                'name'  => $homeslider->getCaption(),
                'description'   => $homeslider->getCaption(),
                'url' => Mage::helper('adminhtml')->getUrl('*/slider_homeslider/edit', array('id'=>$homeslider->getId())),
            );
        }
        $this->setResults($arr);
        return $this;
    }
}
