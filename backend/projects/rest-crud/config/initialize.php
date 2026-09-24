<?php

// config/initilize.php
return [
    'base'       => dirname(__DIR__, 4),
    'db'         => dirname(__DIR__, 4) . '/backend/config',
    'app'        => dirname(__DIR__, 4) . '/backend/projects/rest-crud',
    'config'     => dirname(__DIR__, 4) . '/backend/projects/rest-crud/config',
    'controller' => dirname(__DIR__, 4) . '/backend/projects/rest-crud/controllers',
    'model'      => dirname(__DIR__, 4) . '/backend/projects/rest-crud/model',
    'api'        => dirname(__DIR__, 4) . '/backend/projects/rest-crud/api',
    'helper'     => dirname(__DIR__, 4) . '/backend/helper',
];
