<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponseTrait;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

/**
 *  @OA\Tag(
 *      name="Authentication",
 *      description="Dapatkan token yang akan digunakan untuk mengakses API"
 *  ),
 *  @OA\Info(
 *      title="Backend",
 *          version="0.1"
 *  ),
 *  @OA\Server(
 *     description="LIVE server",
 *     url="/api/",
 *   ),
 */
class BaseApiController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, ApiResponseTrait;
}