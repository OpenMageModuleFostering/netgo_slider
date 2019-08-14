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
class Netgo_Slider_Block_Adminhtml_Homeslider_Grid
    extends Mage_Adminhtml_Block_Widget_Grid {
    /**
     * constructor
     * @access public
     * @author Vipin
     */
    public function __construct(){
        parent::__construct();
        $this->setId('homesliderGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
    /**
     * prepare collection
     * @access protected
     * @return Netgo_Slider_Block_Adminhtml_Homeslider_Grid
     * @author Vipin
     */
    protected function _prepareCollection(){
        $collection = Mage::getModel('netgo_slider/homeslider')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    /**
     * prepare grid collection
     * @access protected
     * @return Netgo_Slider_Block_Adminhtml_Homeslider_Grid
     * @author Vipin
     */
    protected function _prepareColumns(){
        $this->addColumn('entity_id', array(
            'header'    => Mage::helper('netgo_slider')->__('Id'),
            'index'        => 'entity_id',
            'type'        => 'number'
        ));
        $this->addColumn('caption', array(
            'header'    => Mage::helper('netgo_slider')->__('Caption'),
            'align'     => 'left',
            'index'     => 'caption',
        ));
        $this->addColumn('status', array(
            'header'    => Mage::helper('netgo_slider')->__('Status'),
            'index'        => 'status',
            'type'        => 'options',
            'options'    => array(
                '1' => Mage::helper('netgo_slider')->__('Enabled'),
                '0' => Mage::helper('netgo_slider')->__('Disabled'),
            )
        ));
        if (!Mage::app()->isSingleStoreMode() && !$this->_isExport) {
            $this->addColumn('store_id', array(
                'header'=> Mage::helper('netgo_slider')->__('Store Views'),
                'index' => 'store_id',
                'type'  => 'store',
                'store_all' => true,
                'store_view'=> true,
                'sortable'  => false,
                'filter_condition_callback'=> array($this, '_filterStoreCondition'),
            ));
        }
        $this->addColumn('created_at', array(
            'header'    => Mage::helper('netgo_slider')->__('Created at'),
            'index'     => 'created_at',
            'width'     => '120px',
            'type'      => 'datetime',
        ));
        $this->addColumn('updated_at', array(
            'header'    => Mage::helper('netgo_slider')->__('Updated at'),
            'index'     => 'updated_at',
            'width'     => '120px',
            'type'      => 'datetime',
        ));
        $this->addColumn('action',
            array(
                'header'=>  Mage::helper('netgo_slider')->__('Action'),
                'width' => '100',
                'type'  => 'action',
                'getter'=> 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('netgo_slider')->__('Edit'),
                        'url'   => array('base'=> '*/*/edit'),
                        'field' => 'id'
                    )
                ),
                'filter'=> false,
                'is_system'    => true,
                'sortable'  => false,
        ));
        $this->addExportType('*/*/exportCsv', Mage::helper('netgo_slider')->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper('netgo_slider')->__('Excel'));
        $this->addExportType('*/*/exportXml', Mage::helper('netgo_slider')->__('XML'));
        return parent::_prepareColumns();
    }
    /**
     * prepare mass action
     * @access protected
     * @return Netgo_Slider_Block_Adminhtml_Homeslider_Grid
     * @author Vipin
     */
    protected function _prepareMassaction(){
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('homeslider');
        $this->getMassactionBlock()->addItem('delete', array(
            'label'=> Mage::helper('netgo_slider')->__('Delete'),
            'url'  => $this->getUrl('*/*/massDelete'),
            'confirm'  => Mage::helper('netgo_slider')->__('Are you sure?')
        ));
        $this->getMassactionBlock()->addItem('status', array(
            'label'=> Mage::helper('netgo_slider')->__('Change status'),
            'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
            'additional' => array(
                'status' => array(
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => Mage::helper('netgo_slider')->__('Status'),
                        'values' => array(
                                '1' => Mage::helper('netgo_slider')->__('Enabled'),
                                '0' => Mage::helper('netgo_slider')->__('Disabled'),
                        )
                )
            )
        ));
        return $this;
    }
    /**
     * get the row url
     * @access public
     * @param Netgo_Slider_Model_Homeslider
     * @return string
     * @author Vipin
     */
    public function getRowUrl($row){
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
    /**
     * get the grid url
     * @access public
     * @return string
     * @author Vipin
     */
    public function getGridUrl(){
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }
    /**
     * after collection load
     * @access protected
     * @return Netgo_Slider_Block_Adminhtml_Homeslider_Grid
     * @author Vipin
     */
    protected function _afterLoadCollection(){
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }
    /**
     * filter store column
     * @access protected
     * @param Netgo_Slider_Model_Resource_Homeslider_Collection $collection
     * @param Mage_Adminhtml_Block_Widget_Grid_Column $column
     * @return Netgo_Slider_Block_Adminhtml_Homeslider_Grid
     * @author Vipin
     */
    protected function _filterStoreCondition($collection, $column){
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }
        $collection->addStoreFilter($value);
        return $this;
    }
}
