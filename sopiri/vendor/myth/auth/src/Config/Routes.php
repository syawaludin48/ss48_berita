<?php

/**
 * Myth:Auth routes file.
 */

$routes->group('', ['namespace' => 'Myth\Auth\Controllers'], function($routes) {
	
	$routes->get('login', 'AuthController::login', ['as' => 'login']);
	$routes->post('login.process', 'AuthController::attemptLogin', ['as' => 'login.process'] );
    $routes->get('logout', 'AuthController::logout');

    $routes->get('register', 'AuthController::register', ['as' => 'register']);
    $routes->post('register', 'AuthController::attemptRegister');

    $routes->get('activate-account', 'AuthController::activateAccount', ['as' => 'activate-account']);
    $routes->get('resend-activate-account', 'AuthController::resendActivateAccount', ['as' => 'resend-activate-account']);

    $routes->get('forgot', 'AuthController::forgotPassword', ['as' => 'forgot']);
    $routes->post('forgot', 'AuthController::attemptForgot');
    $routes->get('reset-password', 'AuthController::resetPassword', ['as' => 'reset-password']);
    $routes->post('reset-password', 'AuthController::attemptReset');
});

