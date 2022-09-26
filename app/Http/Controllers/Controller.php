<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
/**
 * @OA\Info(
 *    title="Your super  ApplicationAPI",
 *    version="1.0.0",
 * )
 * @OA\Get(
 *     path="/api/v1",
 *     @OA\Response(response="200", description="An example endpoint")
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
