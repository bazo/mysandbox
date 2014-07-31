<?php

namespace Users;



/**
 * Users management.
 */
class UserManager extends Nette\Object implements Nette\Security\IAuthenticator
{

	/** @var Crypt_Base */
	private $cipher;

	function __construct(Crypt_Base $cipher)
	{
		$this->cipher = $cipher;
	}


	/**
	 * Performs an authentication.
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;
	}


}