<?php



class Dcs_Homebanner_Block_Adminhtml_Homebanner_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form

{

  protected function _prepareForm()

  {

      $form = new Varien_Data_Form();

      $this->setForm($form);

      $fieldset = $form->addFieldset('homebanner_form', array('legend'=>Mage::helper('homebanner')->__('Banner information')));

     

      $fieldset->addField('title', 'text', array(

          'label'     => Mage::helper('homebanner')->__('Banner Name'),          

          'name'      => 'title',
		  'required'  => true,

		  'class'     => 'required-entry',

      ));

	  

	  

	 $fieldset->addField('filename', 'image', array(

          'label'     => Mage::helper('homebanner')->__('Banner Image'),

          'required'  => true,

		  'class'     => 'required-entry',

          'name'      => 'filename',

		  'note' => '(Dimensions for Desktop: 1920px * 800px)<br>(Dimensions for Mobile: 320px * 133px)',		  

	  ));

	  

	  $fieldset->addField('visibility', 'select', array(

          'label'     => Mage::helper('homebanner')->__('Banner Visibility'),

          'name'      => 'visibility',

		  'required'  => true,

		  'class'     => 'required-entry',

          'values'    => array(

              array(

                  'value'     => 1,

                  'label'     => Mage::helper('homebanner')->__('Desktop'),

              ),



              array(

                  'value'     => 2,

                  'label'     => Mage::helper('homebanner')->__('Mobile'),

              ),

			  

			  array(

                  'value'     => 3,

                  'label'     => Mage::helper('homebanner')->__('Both'),

              ),

          ),

      ));

	   



     $fieldset->addField('bannerlink', 'text', array(

          'label'     => Mage::helper('homebanner')->__('Link'),          

          'name'      => 'bannerlink',

	  ));

	  

	  /*$fieldset->addField('slogan_desktop', 'editor', array(

          'label'     => Mage::helper('homebanner')->__('Desktop Slogan'),          

          'name'      => 'slogan_desktop',

      ));*/

	  

	  /*$fieldset->addField('slogan_mobile', 'editor', array(

          'label'     => Mage::helper('homebanner')->__('Mobile Slogan'),          

          'name'      => 'slogan_mobile',

      ));*/

	  

	  $fieldset->addField('rank', 'text', array(

          'label'     => Mage::helper('homebanner')->__('Rank'),          

          'name'      => 'rank',

		  'required'  => true,

		  'class'     => 'required-entry',

      ));

      

	  

	  

if (!Mage::app()->isSingleStoreMode()) {

    $fieldset->addField('store_id', 'multiselect', array(

        'name' => 'stores[]',

        'label' => Mage::helper('homebanner')->__('Store View'),

        'title' => Mage::helper('homebanner')->__('Store View'),

        'required' => true,

        'values' => Mage::getSingleton('adminhtml/system_store')

                     ->getStoreValuesForForm(false, true),

    ));

}

else {

    $fieldset->addField('store_id', 'hidden', array(

        'name' => 'stores[]',

        'value' => Mage::app()->getStore(true)->getId()

    ));

}

	  

		

      $fieldset->addField('status', 'select', array(

          'label'     => Mage::helper('homebanner')->__('Status'),

          'name'      => 'status',

		  'required'  => true,

		  'class'     => 'required-entry',

          'values'    => array(

              array(

                  'value'     => 1,

                  'label'     => Mage::helper('homebanner')->__('Enabled'),

              ),



              array(

                  'value'     => 2,

                  'label'     => Mage::helper('homebanner')->__('Disabled'),

              ),

          ),

      ));

     

      /*$fieldset->addField('content', 'editor', array(

          'name'      => 'content',

          'label'     => Mage::helper('homebanner')->__('Content'),

          'title'     => Mage::helper('homebanner')->__('Content'),

          'style'     => 'width:700px; height:500px;',

          'wysiwyg'   => false,

          'required'  => true,

      ));*/

     

      if ( Mage::getSingleton('adminhtml/session')->getHomebannerData() )

      {

          $form->setValues(Mage::getSingleton('adminhtml/session')->getHomebannerData());

          Mage::getSingleton('adminhtml/session')->setHomebannerData(null);

      } elseif ( Mage::registry('homebanner_data') ) {

          $form->setValues(Mage::registry('homebanner_data')->getData());

      }

	  $p = $form->getElement('filename')->getValue();



      $form->getElement('filename')->setValue($p);

      return parent::_prepareForm();

  }

}