<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiResponse;
use App\Http\Controllers\Controller as BaseController;

abstract class ApiBaseController extends BaseController
{
    /**
     * Response;
     *
     * @var Response
     */
    protected $response;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->response = new Response();
    }
}