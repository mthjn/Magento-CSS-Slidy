<?php
class CSSSlidy_Slider_Helper_Config extends Mage_Core_Helper_Abstract
{
    private $_configs;
    private $_sliders;
    private $_media;


    public function __construct()
    {
        $this->_configs = Mage::getStoreConfig('cssslidy');
        $this->_media = Mage::getBaseUrl('media') . 'cssslidy/slider/';

        $this->setSliders();
    }

    private function setSliders()
    {
        $sliderItems = array();

        $item = 0;
        for ($i = 0; $i < 6; $i++)
        {
            if (isset($this->_configs["slideritem$i"]['image']))
            {
                if ($this->_configs["slideritem$i"]['image'] != null && $this->_configs["slideritem$i"]['image'] != '')
                {
                    $sliderItems[$item]['link'] = $this->_configs["slideritem$i"]['link'];
                    $item++;
                }
            }
        }

        if (!isset($sliderItems[0]))
        {

            $sliderItems[0]['link'] = 'http://placehold.it/890x380';
            $sliderItems[1]['link'] = 'http://placehold.it/890x380';
            $sliderItems[2]['link'] = 'http://placehold.it/890x380';
            $sliderItems[3]['link'] = 'http://placehold.it/890x380';
            $sliderItems[4]['link'] = 'http://placehold.it/890x380';
        }

        $this->_sliders = $sliderItems;
    }

    public function getSliders()
    {
        return $this->_sliders;
    }
}
