<?php

class Dcs_Homebanner_Block_Adminhtml_Homebanner_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('homebannerGrid');
      $this->setDefaultSort('homebanner_id');
      $this->setDefaultDir('DESC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('homebanner/homebanner')->getCollection();
	  	  	  
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('homebanner_id', array(
          'header'    => Mage::helper('homebanner')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'homebanner_id',
      ));
	   $this->addColumn('filename', array(
          'header'    => Mage::helper('homebanner')->__('Banner Image'),
          'align'     =>'left',
          'index'     => 'filename',
          'renderer'  => 'homebanner/adminhtml_homebanner_renderer_image', 
      ));

      $this->addColumn('title', array(
          'header'    => Mage::helper('homebanner')->__('Banner Name'),
          'align'     =>'left',
          'index'     => 'title',
      ));
	  
	  /*$this->addColumn('store_id', array( 
	'header' => Mage::helper('homebanner')->__('Website'), 
	'index' => 'store_id', 
	'type' => 'store', 
	'width' => '100px', 
	'store_view' => true, 
	'display_deleted' => false, 
	));*/
	
	/*if (!Mage::app()->isSingleStoreMode()) {
    $this->addColumn('store_id', array(
        'header'        => Mage::helper('homebanner')->__('Store View'),
        'index'         => 'store_id',
        'type'          => 'store',
        'store_all'     => true,
        'store_view'    => true,
        'sortable'      => false,
        
    ));
	}*/
	

	  /*
      $this->addColumn('content', array(
			'header'    => Mage::helper('homebanner')->__('Item Content'),
			'width'     => '150px',
			'index'     => 'content',
      ));
	  */
	  
	  $this->addColumn('visibility', array(
          'header'    => Mage::helper('homebanner')->__('Banner Visibility'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'visibility',
          'type'      => 'options',
          'options'   => array(
              1 => 'Desktop',
              2 => 'Mobile',
			  3 => 'Both',
          ),
      ));
	  
	  $this->addColumn('rank', array(
          'header'    => Mage::helper('homebanner')->__('Rank'),
          'align'     =>'left',
          'index'     => 'rank',
		  'width'     => '80px',
      ));

      $this->addColumn('status', array(
          'header'    => Mage::helper('homebanner')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('homebanner')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('homebanner')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('homebanner')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('homebanner')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('homebanner_id');
        $this->getMassactionBlock()->setFormFieldName('homebanner');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('homebanner')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('homebanner')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('homebanner/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('homebanner')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('homebanner')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}