<?php

include_once('core/core.php');
Core::requires('database', 'smarty.template', 'routing');
Routing::route($_SERVER['REQUEST_URI']);