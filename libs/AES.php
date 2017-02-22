<?php
/**
 * @author william
 * @todo AES算法(128加密)
 */
define('Crypto_CIPHER_BLOCK_SIZE',16);
class AES128{
	/**
	 * @todo 加密
	 */
	function aes128cbcEncrypt($key, $text) {
		/* Open the cipher */
		$td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
		if (! $td) {
			throw new GeneralSecurityException('Invalid mcrypt cipher, check your libmcrypt library and php-mcrypt extention');
		}
		// replaced MCRYPT_DEV_RANDOM with MCRYPT_RAND since windows doesn't have /dev/rand :)
		srand((double)microtime() * 1000000);
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		/* Intialize encryption */
		mcrypt_generic_init($td, $key, $iv);
		/* Encrypt data */
		$encrypted = mcrypt_generic($td, $text);
		/* Terminate encryption handler */
		mcrypt_generic_deinit($td);
		/*
		 *  AES-128-CBC encryption.  The IV is returned as the first 16 bytes
		* of the cipher text.
		*/
		return $iv . $encrypted;
	}
	/**
	 * @todo 解密
	 */
	function aes128cbcDecrypt($key, $encrypted_text) {
		/* Open the cipher */
		$td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
		if (is_callable('mb_substr')) {
			$iv = mb_substr($encrypted_text, 0, Crypto_CIPHER_BLOCK_SIZE, 'latin1');
		} else {
			$iv = substr($encrypted_text, 0, Crypto_CIPHER_BLOCK_SIZE);
		}
		/* Initialize encryption module for decryption */
		mcrypt_generic_init($td, $key, $iv);
		/* Decrypt encrypted string */
		if (is_callable('mb_substr')) {
			$encrypted = mb_substr($encrypted_text, Crypto_CIPHER_BLOCK_SIZE, mb_strlen($encrypted_text, 'latin1'), 'latin1');
		} else {
			$encrypted = substr($encrypted_text, Crypto_CIPHER_BLOCK_SIZE);
		}
		$decrypted = mdecrypt_generic($td, $encrypted);
		/* Terminate decryption handle and close module */
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		/* Show string */
		return trim($decrypted);
	}
	
	
	
	
}


/**
 * @todo 算法2
 */
class Security {

	public static function encrypt($input, $key) {

		$size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);

		$input = Security::pkcs5_pad($input, $size);

		$td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '');

		$iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);

		mcrypt_generic_init($td, $key, $iv);

		$data = mcrypt_generic($td, $input);

		mcrypt_generic_deinit($td);

		mcrypt_module_close($td);

		$data = base64_encode($data);

		return $data;

	}



	private static function pkcs5_pad ($text, $blocksize) {

		$pad = $blocksize - (strlen($text) % $blocksize);

		return $text . str_repeat(chr($pad), $pad);

	}



	public static function decrypt($sStr, $sKey) {

		$decrypted= mcrypt_decrypt(

				MCRYPT_RIJNDAEL_128,

				$sKey,

				base64_decode($sStr),

				MCRYPT_MODE_ECB

		);



		$dec_s = strlen($decrypted);

		$padding = ord($decrypted[$dec_s-1]);

		$decrypted = substr($decrypted, 0, -$padding);

		return $decrypted;

	}

}







/* $key = "1234567891234567";

$data = "example";



$value = Security::encrypt($data , $key );

echo $value.'<br/>';

echo Security::decrypt($value, $key ); */


/* 
$a= aes128cbcEncrypt('pass','this is text');
echo base64_encode($a)."/r/n";
$b= aes128cbcDecrypt('pass',$a);
echo $b."/r/n";
$c= aes128cbcDecrypt('pass',base64_decode(base64_encode($a)));
echo $c."/r/n"; */




