<?php

require_once 'config.inc.php';
require_once APP_ROOT . '/classes/Auth.class.php';

Auth::isLogged(true, 0);