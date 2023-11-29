<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

/**
 * Match all responses to the requested format
 */
trait CustomResponseTrait
{
    public function customResponse(array $data, int $responseCode=200): JsonResponse
    {
        return response()->json([
            'data'  => $data,
            'server_time'   => Carbon::now(),
        ], $responseCode);
    }
}
