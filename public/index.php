<?php

session_start();

require_once __DIR__ . './../src/Views/Partials/header.php';

require_once "./../src/init.php";

// je require le header en dessous du init pour start la session avant d'inclure les components qui utilisent la session
