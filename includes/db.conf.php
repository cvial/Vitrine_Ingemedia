<?php

	// Active Record
	ActiveRecord\Config::initialize(function($cfg) {
		$cfg->set_model_directory(DOC_ROOT . '/models/');
		$cfg->set_connections(array(
			'development' => 'mysql://root:@localhost/vitrine_ingemedia;charset=utf8'));
	});
