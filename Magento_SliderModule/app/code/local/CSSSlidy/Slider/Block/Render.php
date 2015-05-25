<?php
/**
Usage
{{block type=""}}
**/
class CSSSlidy_Slider_Block_Render extends Mage_Core_Block_Template {

  public function _toHtml() {
    $ModelGetimages = Mage::getModel('CSSSlidy_Slider/Getimages');
    $mediadir = $ModelGetimages->defineMediaDir();
    $array = $ModelGetimages->getDirFiles($mediadir);
    $localmedia = $ModelGetimages->getLocalPath();
    $imgtitle = $this->getLayout()->getBlock('head')->getTitle();
    $imgalt = $imgtitle . " Slider";
    /**
      Template Renderer
    **/ ?>
      <div id="slidy-container" style="width: 100%; overflow: hidden;margin-top: -7px;">
         <figure id="slidy">
          <?php foreach ($array as $key => $file) {
            $sliderurl = $localmedia . $file;?>
              <img src="<?php echo $sliderurl; ?>" title="<?php echo $imgtitle; ?>" alt="<?php echo $imgalt; ?>">
          <?php  }  ?>
          </figure>
      </div>
  <?php }
}
