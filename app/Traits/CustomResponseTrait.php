<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

trait CustomResponseTrait
{
    public function customResponse(array $data, $responseCode=200): JsonResponse
    {
        return response()->json([
            'data'  => $data,
            'server_time'   => Carbon::now(),
        ], $responseCode);
    }
}
