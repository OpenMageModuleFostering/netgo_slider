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
class Netgo_Slider_Adminhtml_Slider_HomesliderController
    extends Netgo_Slider_Controller_Adminhtml_Slider {
    /**
     * init the homeslider
     * @access protected
     * @return Netgo_Slider_Model_Homeslider
     */
    protected function _initHomeslider(){
        $homesliderId  = (int) $this->getRequest()->getParam('id');
        $homeslider    = Mage::getModel('netgo_slider/homeslider');
        if ($homesliderId) {
            $homeslider->load($homesliderId);
        }
        Mage::register('current_homeslider', $homeslider);
        return $homeslider;
    }
     /**
     * default action
     * @access public
     * @return void
     * @author Vipin
     */
    public function indexAction() {
        $this->loadLayout();
        $this->_title(Mage::helper('netgo_slider')->__('Home Background Slider'))
             ->_title(Mage::helper('netgo_slider')->__('Homeslider'));
        $this->renderLayout();
    }
    /**
     * grid action
     * @access public
     * @return void
     * @author Vipin
     */
    public function gridAction() {
        $this->loadLayout()->renderLayout();
    }
    /**
     * edit homeslider - action
     * @access public
     * @return void
     * @author Vipin
     */
    public function editAction() {
        $homesliderId    = $this->getRequest()->getParam('id');
        $homeslider      = $this->_initHomeslider();
        if ($homesliderId && !$homeslider->getId()) {
            $this->_getSession()->addError(Mage::helper('netgo_slider')->__('This homeslider no longer exists.'));
            $this->_redirect('*/*/');
            return;
        }
        $data = Mage::getSingleton('adminhtml/session')->getHomesliderData(true);
        if (!empty($data)) {
            $homeslider->setData($data);
        }
        Mage::register('homeslider_data', $homeslider);
        $this->loadLayout();
        $this->_title(Mage::helper('netgo_slider')->__('Home Background Slider'))
             ->_title(Mage::helper('netgo_slider')->__('Homeslider'));
        if ($homeslider->getId()){
            $this->_title($homeslider->getCaption());
        }
        else{
            $this->_title(Mage::helper('netgo_slider')->__('Add homeslider'));
        }
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        $this->renderLayout();
    }
    /**
     * new homeslider action
     * @access public
     * @return void
     * @author Vipin
     */
    public function newAction() {
        $this->_forward('edit');
    }
    /**
     * save homeslider - action
     * @access public
     * @return void
     * @author Vipin
     */
    public function saveAction() {
        if ($data = $this->getRequest()->getPost('homeslider')) {
            try {
                $homeslider = $this->_initHomeslider();
                $homeslider->addData($data);
                $imageName = $this->_uploadAndGetName('image', Mage::helper('netgo_slider/homeslider_image')->getImageBaseDir(), $data);
                $homeslider->setData('image', $imageName);
                $mobileimageName = $this->_uploadAndGetName('mobileimage', Mage::helper('netgo_slider/homeslider_image')->getImageBaseDir(), $data);
                $homeslider->setData('mobileimage', $mobileimageName);
                $homeslider->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('netgo_slider')->__('Homeslider was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $homeslider->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            }
            catch (Mage_Core_Exception $e){
                if (isset($data['image']['value'])){
                    $data['image'] = $data['image']['value'];
                }
                if (isset($data['mobileimage']['value'])){
                    $data['mobileimage'] = $data['mobileimage']['value'];
                }
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setHomesliderData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
            catch (Exception $e) {
                Mage::logException($e);
                if (isset($data['image']['value'])){
                    $data['image'] = $data['image']['value'];
                }
                if (isset($data['mobileimage']['value'])){
                    $data['mobileimage'] = $data['mobileimage']['value'];
                }
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('netgo_slider')->__('There was a problem saving the homeslider.'));
                Mage::getSingleton('adminhtml/session')->setHomesliderData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('netgo_slider')->__('Unable to find homeslider to save.'));
        $this->_redirect('*/*/');
    }
    /**
     * delete homeslider - action
     * @access public
     * @return void
     * @author Vipin
     */
    public function deleteAction() {
        if( $this->getRequest()->getParam('id') > 0) {
            try {
                $homeslider = Mage::getModel('netgo_slider/homeslider');
                $homeslider->setId($this->getRequest()->getParam('id'))->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('netgo_slider')->__('Homeslider was successfully deleted.'));
                $this->_redirect('*/*/');
                return;
            }
            catch (Mage_Core_Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('netgo_slider')->__('There was an error deleting homeslider.'));
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                Mage::logException($e);
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('netgo_slider')->__('Could not find homeslider to delete.'));
        $this->_redirect('*/*/');
    }
    /**
     * mass delete homeslider - action
     * @access public
     * @return void
     * @author Vipin
     */
    public function massDeleteAction() {
        $homesliderIds = $this->getRequest()->getParam('homeslider');
        if(!is_array($homesliderIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('netgo_slider')->__('Please select homeslider to delete.'));
        }
        else {
            try {
                foreach ($homesliderIds as $homesliderId) {
                    $homeslider = Mage::getModel('netgo_slider/homeslider');
                    $homeslider->setId($homesliderId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('netgo_slider')->__('Total of %d homeslider were successfully deleted.', count($homesliderIds)));
            }
            catch (Mage_Core_Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('netgo_slider')->__('There was an error deleting homeslider.'));
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }
    /**
     * mass status change - action
     * @access public
     * @return void
     * @author Vipin
     */
    public function massStatusAction(){
        $homesliderIds = $this->getRequest()->getParam('homeslider');
        if(!is_array($homesliderIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('netgo_slider')->__('Please select homeslider.'));
        }
        else {
            try {
                foreach ($homesliderIds as $homesliderId) {
                $homeslider = Mage::getSingleton('netgo_slider/homeslider')->load($homesliderId)
                            ->setStatus($this->getRequest()->getParam('status'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d homeslider were successfully updated.', count($homesliderIds)));
            }
            catch (Mage_Core_Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('netgo_slider')->__('There was an error updating homeslider.'));
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }
    /**
     * export as csv - action
     * @access public
     * @return void
     * @author Vipin
     */
    public function exportCsvAction(){
        $fileName   = 'homeslider.csv';
        $content    = $this->getLayout()->createBlock('netgo_slider/adminhtml_homeslider_grid')->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }
    /**
     * export as MsExcel - action
     * @access public
     * @return void
     * @author Vipin
     */
    public function exportExcelAction(){
        $fileName   = 'homeslider.xls';
        $content    = $this->getLayout()->createBlock('netgo_slider/adminhtml_homeslider_grid')->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }
    /**
     * export as xml - action
     * @access public
     * @return void
     * @author Vipin
     */
    public function exportXmlAction(){
        $fileName   = 'homeslider.xml';
        $content    = $this->getLayout()->createBlock('netgo_slider/adminhtml_homeslider_grid')->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }
    /**
     * Check if admin has permissions to visit related pages
     * @access protected
     * @return boolean
     * @author Vipin
     */
    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('cms/netgo_slider/homeslider');
    }
}
