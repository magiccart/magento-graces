<?php
/**
 * Magiccart 
 * @category  Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license   http://www.magiccart.net/license-agreement.html
 * @Author: Magiccart<team.magiccart@gmail.com>
 * @@Create Date: 2014-07-28 17:49:00
 * @@Modify Date: 2015-10-20 12:03:16
 * @@Function:
 */
 ?>
<?php
class Magiccart_Testimonial_Block_Widget_Slide extends Magiccart_Testimonial_Block_Testimonial
 	implements Mage_Widget_Block_Interface
{
	protected function _prepareLayout() {
		$head = $this->getLayout()->getBlock('head');
	    $head->addCss('magiccart/plugin/css/jquery.bxslider.css');
	    $head->addCss('magiccart/testimonial/css/testimonial.css');
	    $head->addJs('magiccart/plugin/jquery.bxslider.js');
	    return parent::_prepareLayout();
	}

    public function getDevices()
    { 
        return array('portrait'=>480, 'landscape'=>640, 'tablet'=>768, 'desktop'=>992);
    }

    public function getBxslider()
    {
        $options = array(
            'auto',
            'speed',
            'pause',
            'controls',
            'moveSlides',
            'pager',
            'infiniteLoop',
            'slideMargin',
            'slideWidth',
            'visibleItems',
        );
        $script = '';
        foreach ($options as $opt) {
            $cfg  =  $this->config["$opt"] ? $this->config["$opt"] : 0;
            $script    .= "$opt: $cfg, ";
        }

        $options2 = array(
            'mode'=>'vertical',
        );
        foreach ($options2 as $key => $value) {
            $cfg  =  $this->config["$value"];
            if($cfg){
                $script    .= "$key: '$value', ";
                $script    .= "minSlides: $this->config['visibleItems']";
            }else {
                $fade = $this->config["fade"];
                if($fade) $script    .= "$key: 'fade', ";
            }
        }
        $enableResponsiveBreakpoints = true ;//$this->config['enableResponsiveBreakpoints'] ;
        if($enableResponsiveBreakpoints){
            $script .= 'responsiveBreakpoints: {';
            $responsiveBreakpoints = $this->getDevices();
            $maxSlides = $this->config['visibleItems'];
            foreach ($responsiveBreakpoints as $opt => $screen) {
                $cfg = isset($this->config[$opt]) ? $this->config[$opt] : '';
                if($cfg) $script .= "$screen : $cfg ,";
                if($cfg > $maxSlides) $maxSlides = $cfg;
            }
            $script .= "}, ";
            $script .= "maxSlides : $maxSlides, ";
        }

        return $script;

    }

    public function generateRandomString($length = 10) {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

}

