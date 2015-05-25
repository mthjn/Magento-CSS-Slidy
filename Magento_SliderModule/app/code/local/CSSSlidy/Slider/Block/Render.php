<?php
/**
Usage
{{block type=""}}
**/
class CSSSlidy_Slider_Block_Render extends Mage_Core_Block_Template {

  public function _toHtml() {
/**
Images
**/
   $ModelGetimages = Mage::getModel('CSSSlidy_Slider/Getimages');
    $mediadir = $ModelGetimages->defineMediaDir();
     $array = $ModelGetimages->getDirFiles($mediadir);
      $array_count = $ModelGetimages->countItUp($array);
    $localmedia = $ModelGetimages->getLocalPath();
    $imgtitle = $this->getLayout()->getBlock('head')->getTitle();
     $imgalt = $imgtitle . " Slider";

      $imgsrc = array();
       foreach ($array as $key => $file) {
        $sliderurl = $localmedia . $file;
          $imgsrc[] = '<img src="' . $sliderurl . '" title="' . $imgtitle . '" alt="' . $imgalt . '">';
        }//feach

/**
captions
**/
   $HelperGetCaptions = Mage::helper('CSSSlidy_Slider/Data');
    $divcap = $HelperGetCaptions->getCaptions($array_count);
//print_r($imgsrc);
//print_r($divcap);
/**
                caption and img    what if one empty
                last image JS added image 1 BUT NO caption
                Adds CSS3 Hover transitions for text
                text on 4 rows because of figure
**/
/**Template Renderer**/
     ?>
      <div id="slidy-container">
         <figure id="slidy">
          <?php
             for ($i = 0 ; $i < $array_count; $i++) {?>

                 <?php
                 if (!empty($divcap[$i])) echo $divcap[$i];
                 if (!empty($imgsrc[$i])) echo $imgsrc[$i];
                 ?>

            <?php }//for
            echo $divcap[0]; //1st slide appended for smooth inf roll
           ?>
           </figure>
       </div>
  <?php }//fn
}//class
