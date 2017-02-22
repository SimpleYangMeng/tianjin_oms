<?php
class Common_Barcode
{
	public static function barcode($text){
		 
		$config = new Zend_Config(array(
			'barcode'        => 'code128',
			'barcodeParams'  => array('text' => $text),
			'renderer'       => "image",
			'rendererParams' => array('imageType' => 'gif'),
		));


		$renderer = Zend_Barcode::factory($config);
		return $renderer->render();
	}
	
	 
}