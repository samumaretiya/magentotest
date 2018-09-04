<?php



class Dcs_Homebanner_Block_Adminhtml_Homebanner_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract{

     

    public function render(Varien_Object $row)

    {

        $html = '<img ';

        $html .= 'id="' . $this->getColumn()->getId() . '" ';

        $html .= 'src="' .Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA). $row->getData($this->getColumn()->getIndex()) . '"';

        $html .= 'class="grid-image ' . $this->getColumn()->getInlineCss() . '" width="170" height="100"/>';

        //$html .= '<img src='.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).$row->getData($this->getColumn()->getIndex()).' width="100" height="100">';

        return $html;

    }

}





?>

