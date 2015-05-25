<?php //Model Slider
// Get all images in dir
// Get server path
class CSSSlidy_Slider_Model_Getimages extends Mage_Core_Model_Abstract {

  public function defineMediaDir() {
    $mydir = Mage::getBaseDir('media').DS."cssslidy".DS."slider";
    return $mydir;
  }

  public function getDirFiles($d)
    {
      $dir = dir($d);
        while (false!== ($file = $dir->read()))
        {
      $xt = substr($file, strrpos($file, '.'));
       if($xt == ".jpg" || $xt == ".jpeg" || $xt == ".png" |$xt == ".gif") {
            $filesall[$file] = $file;
          }
          }
      $dir->close();
      asort($filesall);
        return $filesall;
    }
  public function getLocalPath() {
    $path = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA)."cssslidy/slider/";
    return $path;
  }

}//class
