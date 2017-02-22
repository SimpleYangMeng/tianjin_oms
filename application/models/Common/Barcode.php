<?php
class Common_Barcode
{
	public static function barcode($text, $type = 'code128'){
		 
		$config = new Zend_Config(array(
			'barcode'        => $type,
			'barcodeParams'  => array('text' => $text),
			'renderer'       => "image",
			'rendererParams' => array('imageType' => 'gif'),
		));


		$renderer = Zend_Barcode::factory($config);
		return $renderer->render();
	}
	
	 
}