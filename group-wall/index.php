<?php

include_once('core/core.php');
requires('database', 'template', 'routing');
Routing::route($_SERVER['REQUEST_URI']);