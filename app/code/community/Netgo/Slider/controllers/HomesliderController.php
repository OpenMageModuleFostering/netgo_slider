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
class Netgo_Slider_HomesliderController
    extends Mage_Core_Controller_Front_Action {
    /**
      * default action
      * @access public
      * @return void
      * @author Vipin
      */
    public function indexAction(){
         $this->loadLayout();
         $this->_initLayoutMessages('catalog/session');
         $this->_initLayoutMessages('customer/session');
         $this->_initLayoutMessages('checkout/session');
         if (Mage::helper('netgo_slider/homeslider')->getUseBreadcrumbs()){
             if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')){
                 $breadcrumbBlock->addCrumb('home', array(
                            'label'    => Mage::helper('netgo_slider')->__('Home'),
                            'link'     => Mage::getUrl(),
                        )
                 );
                 $breadcrumbBlock->addCrumb('homesliders', array(
                            'label'    => Mage::helper('netgo_slider')->__('Homeslider'),
                            'link'    => '',
                    )
                 );
             }
         }
        $this->renderLayout();
    }
    /**
     * init Homeslider
     * @access protected
     * @return Netgo_Slider_Model_Entity
     * @author Vipin
     */
    protected function _initHomeslider(){
        $homesliderId   = $this->getRequest()->getParam('id', 0);
        $homeslider     = Mage::getModel('netgo_slider/homeslider')
                        ->setStoreId(Mage::app()->getStore()->getId())
                        ->load($homesliderId);
        if (!$homeslider->getId()){
            return false;
        }
        elseif (!$homeslider->getStatus()){
            return false;
        }
        return $homeslider;
    }
    /**
      * view homeslider action
      * @access public
      * @return void
      * @author Vipin
      */
    public function viewAction(){
        $homeslider = $this->_initHomeslider();
        if (!$homeslider) {
            $this->_forward('no-route');
            return;
        }
        Mage::register('current_homeslider', $homeslider);
        $this->loadLayout();
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('checkout/session');
        if ($root = $this->getLayout()->getBlock('root')) {
            $root->addBodyClass('slider-homeslider slider-homeslider' . $homeslider->getId());
        }
        if (Mage::helper('netgo_slider/homeslider')->getUseBreadcrumbs()){
            if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')){
                $breadcrumbBlock->addCrumb('home', array(
                            'label'    => Mage::helper('netgo_slider')->__('Home'),
                            'link'     => Mage::getUrl(),
                        )
                );
                $breadcrumbBlock->addCrumb('homesliders', array(
                            'label'    => Mage::helper('netgo_slider')->__('Homeslider'),
                            'link'    => Mage::helper('netgo_slider/homeslider')->getHomeslidersUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb('homeslider', array(
                            'label'    => $homeslider->getCaption(),
                            'link'    => '',
                    )
                );
            }
        }
        $this->renderLayout();
    }
}
