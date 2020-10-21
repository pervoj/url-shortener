<?php
    // Define CONF constant and load configuration into it
    if (file_exists('.htconfig')) { // Check if .htconfig file exists
        // Load .htconfig file
        define('CONF', parse_ini_file('.htconfig'));
    } else {
        // Kill application with error
        die('Failed to load .htconfig file.');
    }

    // Define LANG and DLANG constant and load translation into it
    if (file_exists('langs/' . CONF['lg_trans'] . '.ini')) { // Check if setted translation exists
        // Load setted translation
        define('LANG', parse_ini_file('langs/' . CONF['lg_trans'] . '.ini'));

        // Load default translation into it
        define('DLANG', parse_ini_file('langs/' . CONF['lg_default'] . '.ini'));
    } elseif (file_exists('langs/en.ini')) { // Check if English translation exists
        // Load English translation
        define('LANG', parse_ini_file('langs/en.ini'));

        // Load default translation into it
        define('DLANG', parse_ini_file('langs/' . CONF['lg_default'] . '.ini'));
    } else {
        // Kill application with error
        die('Failed to load application translation.');
    }

    // Set config getter function
    function conf($key) {
        return htmlspecialchars(CONF[$key]);
    }

    // Set translation getter function
    function lang($key) {
        if (!isset(LANG[$key]) || empty(LANG[$key])) {
            if (!isset(DLANG[$key]) || empty(DLANG[$key])) {
                $word = '-';
            } else {
                $word = DLANG[$key];
            }
        } else {
            $word = LANG[$key];
        }
        return htmlspecialchars($word);
    }

    // Test DB connection
    $connect = true;
    $open = true;
    $link = mysqli_connect(conf('db_host'), conf('db_user'), conf('db_pass')) or $connect = false;
    if ($connect) {
        mysqli_select_db($link, conf('db_name')) or $open = false;
    }

    // Check DB test result
    if ($connect && $open) {
        // Include Db class
        include_once('Db.php');

        // Connect to DB via Db class
        Db::connect(conf('db_host'), conf('db_user'), conf('db_pass'), conf('db_name'));
    } else {
        // Kill application with error
        die(lang('ew_dbconnect'));
    }