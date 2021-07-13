<?php

namespace App\Traits;

trait ApiResponser
{
    private function successResponse($message, $data, $code)
	{
		return response()->json([
            'message' => $message,
            'data' => $data,
            'code' => $code,
        ]);
	}

	protected function errorResponse($message, $code)
	{
		return response()->json(['error' => $message, 'code' => $code], $code);
	}
}