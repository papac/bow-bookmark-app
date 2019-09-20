<?php

/**
 * Loading roads..
 *
 * Here is where you need to register all the routes in your application.
 * You'll see, it's a breeze.
 *
 * Just tell Bow which URIs he should answer and give him the
 * controller to call when this URL is requested.
 *
 * Follow the following example, it gives you an overview on how it works in general.
 */
$app->get('/status', function () {
    return ['status' => 'ok'];
});

$app->post('/auth', 'AuthController::make');
$app->post('/register', 'UserController::create');

$app->middleware('policier');
$app->rest('/bookmarks', 'BookmarkController');
