<?php

use Nette\Utils\Strings;

require __DIR__ . '/../vendor/autoload.php';

$configurator = new Nette\Configurator;

$environmentFile = __DIR__ . '/local/environment';
if (file_exists($environmentFile)) {
	$environment = file_get_contents($environmentFile);
	$debugMode = $environment === 'production' ? FALSE : TRUE;
} else {
	$environment = 'production';
}
$environment = Strings::trim(Strings::lower($environment));

$debugSwitchFile = __DIR__ . '/local/debug';

if (file_exists($debugSwitchFile)) {
	$debugMode = Strings::trim(mb_strtolower(file_get_contents($debugSwitchFile))) === 'true' ? TRUE : FALSE;
}

$configurator->setDebugMode($debugMode);
$configurator->enableDebugger(__DIR__ . '/../log');

$configurator->setTempDirectory(__DIR__ . '/../temp');

$configurator->createRobotLoader()
		->addDirectory(__DIR__)
		->addDirectory(__DIR__ . '/../libs')
		->register();

$configurator->addConfig(__DIR__ . '/config/config.neon');

$environmentConfigFile = __DIR__ . sprintf('/config/%s.neon', $environment);
if (file_exists($environmentConfigFile)) {
	$configurator->addConfig($environmentConfigFile);
}

$localConfigFile = __DIR__ . '/local/config.local.neon';
if (file_exists($localConfigFile)) {
	$configurator->addConfig($localConfigFile);
}

$container = $configurator->createContainer();

return $container;
