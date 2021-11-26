<?php

DEFINE('PAGE_SIGNIN', './signin');
DEFINE('PAGE_SIGNUP', './signup');
DEFINE('PAGE_SIGNUP_SUCCES', './signUp');
DEFINE('PAGE_LOGOUT', './logout');
DEFINE('PAGE_NEW_PASSWORD', './reset-password');
DEFINE('PAGE_FORGOT_PASSWORD', './forgot-password');
DEFINE('PAGE_SHOW_DEGUSTATION', './show-degustation');

DEFINE('PAGE_TASTING', SITE_URL . 'tasting/#id#');
DEFINE('PAGE_TASTINGS', SITE_URL . 'tastings');
DEFINE('PAGE_TASTINGS_BY_PAGE', SITE_URL . 'tastings/#page#');

DEFINE('PAGE_TASTINGS_VISITOR', SITE_URL . 'tastings/visitor');
DEFINE('PAGE_TASTINGS_VISITOR_BY_PAGE', SITE_URL . 'tastings/visitor/#page#');

DEFINE('PAGE_TASTINGS_ADD', SITE_URL . 'tastings/add');


DEFINE('PAGE_USER_TASTINGS', SITE_URL . 'tastings/user/#userId#');
DEFINE('PAGE_USER_TASTINGS_BY_PAGE', SITE_URL . 'tastings/user/#userId#/#page#');

DEFINE('PAGE_HOME', SITE_URL . 'home');

DEFINE('PAGE_DASHBOARD', SITE_URL . 'dashboard');

DEFINE('PARTIAL_TASTING', 'tasting_summary');
DEFINE('PARTIAL_ALL_TASTINGS', 'tasting_summary_bis');

DEFINE('PARTIAL_ADD_TASTING_FORM_1', 'add_tasting_form_1');
DEFINE('PARTIAL_ADD_TASTING_FORM_2', 'add_tasting_form_2');
DEFINE('PARTIAL_ADD_TASTING_FORM_3', 'add_tasting_form_3');
DEFINE('PARTIAL_ADD_TASTING_FORM_4', 'add_tasting_form_4');