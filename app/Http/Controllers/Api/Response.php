<?php

namespace App\Http\Controllers\Api;

use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;

class Response
{
    private $fractal;

    public function __construct()
    {
        $this->fractal = new Manager();
    }

    /**
     * Return a transformed item response.
     *
     * @param $item
     * @param $transformer
     * @return \Illuminate\Http\JsonResponse
     */
    public function item($item, $transformer)
    {
        if(request()->has('include')){
            $this->fractal->parseIncludes(request()->input('include'));
        }

        if(request()->has('exclude')){
            $this->fractal->parseExcludes(request()->input('exclude'));
        }

        return response()->json(
            $this->fractal->createData(
                new Item($item, $transformer)
            )->toArray()
        );
    }

    /**
     * Return a transformed collection response.
     *
     * @param $collection
     * @param $transformer
     * @return \Illuminate\Http\JsonResponse
     */
    public function collection($collection, $transformer)
    {
        if(request()->has('include')){
            $this->fractal->parseIncludes(request()->input('include'));
        }

        if(request()->has('exclude')){
            $this->fractal->parseExcludes(request()->input('exclude'));
        }

        return response()->json(
            $this->fractal->createData(
                new Collection($collection, $transformer)
            )->toArray()
        );
    }

    /**
     * Return a created response.
     *
     * @return mixed
     */
    public function created()
    {
        return response()->json('created', 203);
    }

    /**
     * Return accepted response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function accepted()
    {
        return response()->json('accepted', 203);
    }

    /**
     * Return ok response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ok()
    {
        return response()->json('ok', 200);
    }
}