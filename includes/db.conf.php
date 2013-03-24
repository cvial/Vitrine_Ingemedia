<?php

if (ENVIRONMENT == 'development') {
	// Active Record
	ActiveRecord\Config::initialize(function($cfg) {
		$cfg->set_model_directory(DOC_ROOT . '/models/');
		$cfg->set_connections(array(
			'development' => 'mysql://root:root@localhost/alert_domain;charset=utf8'));
	});

} elseif (ENVIRONMENT == 'charlotte') {
	// Active Record
	ActiveRecord\Config::initialize(function($cfg) {
		$cfg->set_model_directory(DOC_ROOT . '/models/');
		$cfg->set_connections(array(
			'development' => 'mysql://root:@localhost/alert_domain;charset=utf8'));
	});

} elseif (ENVIRONMENT == 'preprod') {
	// Active Record
	ActiveRecord\Config::initialize(function($cfg) {
		$cfg->set_model_directory(DOC_ROOT . '/models/');
		$cfg->set_connections(array(
			'development' => 'mysql://root:pS2K2gBD@localhost/preprod;charset=utf8'));
	});
}
