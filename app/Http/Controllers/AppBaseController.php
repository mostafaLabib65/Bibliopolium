<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use InfyOm\Generator\Utils\ResponseUtil;
use Response;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }

    /**
     * Creates models from the raw results (it does not check the fillable attributes and so on)
     * @param array $rawResult
     * @return Collection
     */
    public static function modelsFromRawResults($rawResult = [], $cls)
    {
        $objects = [];

        foreach ($rawResult as $result) {
            $object = new $cls();

            $object->setRawAttributes((array)$result, true);

            $objects[] = $object;
        }

        return new Collection($objects);
    }

    public static function modelFromRawResult($rawResult, $cls)
    {

        $object = new $cls();

        $object->setRawAttributes((array)$rawResult, true);


        return $object;
    }
}
