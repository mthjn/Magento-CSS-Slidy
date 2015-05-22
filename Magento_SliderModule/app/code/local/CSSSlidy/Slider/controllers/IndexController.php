<?php
class CSSSlidy_Slider_IndexController extends Mage_Core_Controller_Front_Action
{
  public function indexAction() {
    echo "Something from inside controller.";
  }
  public function renderAction() {
    echo "Slider";
    //http://localhost/mage/slider/index/render
  }
}
