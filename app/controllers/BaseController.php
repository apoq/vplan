<?php

namespace App\Controllers;

/**
 * Class BaseController
 * @package App\Controllers
 */
class BaseController
{
    /**
     * @param $template
     * @param $arguments
     */
    public function render($template, $arguments = [])
    {
        echo app('view')->render($template, $arguments);
    }

    /**
     * @param $array
     */
    public function renderJson($array)
    {
        header("Content-Type: application/json");
        echo json_encode($array);
    }

    public function respondCreated($array)
    {
        header("Content-Type: application/json");
        http_response_code(201);
        $this->renderJson($array);

        return true;
    }

    public function respondNoContent()
    {
        header("Content-Type: application/json");
        http_response_code(204);

        return true;
    }

    public function respondUnprocessableEntity()
    {
        header("Content-Type: application/json");
        http_response_code(422);

        return true;
    }

    public function respondError()
    {
        header("Content-Type: application/json");
        http_response_code(500);

        return true;
    }

    public function respondNotFound()
    {
        header("Content-Type: application/json");
        http_response_code(404);

        return true;
    }
}