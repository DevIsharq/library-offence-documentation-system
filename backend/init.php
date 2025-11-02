<?php
    // Set session lifetime to 30 minutes (1800 seconds)
    ini_set('session.gc_maxlifetime', 1800);
    session_set_cookie_params(1800);
    session_start();
?>