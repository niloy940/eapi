<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

trait ExceptionTrait
{
    public function apiException($request, $exception)
    {
        if ($this->isModel($exception)) {
            return $this->modelResponse($exception);
        }

        if ($this->isHttp($exception)) {
            return $this->httpResponse($exception);
        }

        return parent::render($request, $exception);
    }


    protected function isModel($exception)
    {
        return $exception instanceof ModelNotFoundException;
    }

    protected function isHttp($exception)
    {
        return $exception instanceof NotFoundHttpException;
    }

    protected function modelResponse($exception)
    {
        return response()->json([
            'errors' => 'Model Not Found!'
        ], Response::HTTP_NOT_FOUND);
    }

    protected function httpResponse($exception)
    {
        response()->json([
                'errors' => 'Incorrect URL!'
            ], Response::HTTP_NOT_FOUND);
    }
}
