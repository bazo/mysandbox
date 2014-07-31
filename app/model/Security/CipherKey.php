<?php

namespace Security;

use Nette\Utils\FileSystem;
use Services\KeyGenerator;



/**
 * @author Martin Bažík <martin@bazik.sk>
 */
class CipherKey
{

	const FILE_NAME = 'cipher_key';


	private $length;

	/** @var string */
	private $storagePath;

	/** @var FileSystem */
	private $fs;

	/** @var KeyGenerator */
	private $generator;


	function __construct($length, $storagePath, FileSystem $fs, KeyGenerator $generator)
	{
		$this->length = $length;
		$this->storagePath = $storagePath;
		$this->fs = $fs;
		$this->generator = $generator;
	}


	public function generate()
	{
		return $this->generator->generateKey($this->length);
	}


	public function write($key)
	{
		$file = $this->getFileName();
		$this->fs->write($file, $key);
	}


	public function read()
	{
		$file = $this->getFileName();
		return file_get_contents($file);
	}


	private function getFileName()
	{
		return $this->storagePath . '/' . self::FILE_NAME;
	}


}
