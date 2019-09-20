<?php

namespace App\Traits;

trait ResponseTrait
{
	/**
	 * Create the response
	 * 
	 * @return array
	 */
	protected function makeResponse($message, $status = true, $data = [])
	{
		if (is_array($status)) {
			$data = $status;
			$status = true;
		}

        return json([
            'status' => ['message' => $message, 'success' => $status],
            'data' => $data
        ]);
	}
}