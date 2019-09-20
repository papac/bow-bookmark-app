<?php

namespace App\Middleware;

use Bow\Http\Request;
use Policier\Bow\PolicierMiddleware as BowPolcierMiddleware;

class PolicierMiddleware extends BowPolcierMiddleware
{
    /**
     * Get Error message
     *
     * @return array
     */
    public function getUnauthorizedMessage()
    {
        return ['status' => [
            'message' => 'unauthorized',
            'error' => true
        ], 'data' => []];
    }

    /**
     * Get Error message
     *
     * @return array
     */
    public function getExpirationMessage()
    {
        return ['status' => [
            'message' => 'token is expired',
            'error' => true
        ], 'data' => []];
    }

}
