<?php

namespace Security;

use Crypt_AES;



/**
 * @author Martin Bažík <martin@bazik.sk>
 */
class CipherFactory
{

	/** @var \Security\CipherKey */
	private $key;


	function __construct(\Security\CipherKey $key)
	{
		$this->key = $key;
	}

	/**
	 * @return \Crypt_AES
	 */
	public function create()
	{
		$cipher = new Crypt_AES(CRYPT_AES_MODE_ECB);
		$cipher->setKey($this->key->read());
		
		return $cipher;
	}


}
