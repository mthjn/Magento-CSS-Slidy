<?php
class CSSSlidy_Slider_Helper_Data extends Mage_Core_Helper_Abstract
{


 public function getCaptions( $count ) {
   //section_name/group_name/field_name
   //'cssslidyslider/slideritem1/caption1'
   $max = $count + 1;
   $captions = array();
     for ($i=1; $i < $max; $i++) {
       $location = 'cssslidyslider/slideritem' . $i . '/caption' . $i;
       $captions[] = Mage::getStoreConfig($location);
     }
   $divcap = array();
    $n = 1;
     foreach ($captions as $key => $value) {
        $divcap[] = '<div class="cssslidy-caption' . $n . '">' . $value . '</div>';
         $n++;
         }//feach
   return $divcap;
 }



}
