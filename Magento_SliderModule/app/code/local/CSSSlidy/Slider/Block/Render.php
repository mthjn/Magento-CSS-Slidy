<?php
// Usage: {{block type="CSSSlidy_Slider/render"}}

class CSSSlidy_Slider_Block_Render extends Mage_Core_Block_Template {

  public function _toHtml() {
/**
Images
**/
   $ModelGetimages = Mage::getModel('CSSSlidy_Slider/Getimages');
    $mediadir = $ModelGetimages->defineMediaDir();
     $array = $ModelGetimages->getDirFiles($mediadir);
      $array_count = $ModelGetimages->countItUp($array);

   $imgtitle = $this->getLayout()->getBlock('head')->getTitle();
    $imgsrc = array();
     $imgsrc = $ModelGetimages->getImgSrc( $array, $imgtitle );
/**
captions
**/
   $HelperGetCaptions = Mage::helper('CSSSlidy_Slider/Data');
    $divcap = $HelperGetCaptions->getCaptions($array_count);
   ?>
      <div id="slidy-container">
         <figure id="slidy">
          <?php
             for ($i = 0 ; $i < $array_count; $i++) {?>
                <div class="innerslidy">
                 <?php
                  if (!empty($divcap[$i])) echo $divcap[$i];
                  if (!empty($imgsrc[$i])) echo $imgsrc[$i];
                 ?>
                </div>
            <?php }//for

            echo $divcap[0]; //1st slide appended for smooth inf roll

           ?>
           </figure>
       </div>
  <?php }//toHtml
}//class
