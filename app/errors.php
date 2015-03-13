<?php


App::error(function(Exception $e)
{
    


    if ( App::environment() == 'local')
    {
        return $e->getPrevious();
    }

    Log::info($e);
    $message = '出错了哦';

    $status_code = 400;
    $message = $e->getMessage();
    $http_code = 400;

    if ($e instanceof Illuminate\Session\TokenMismatchException) {
        $message = '非法跨站请求';
        // return Response::json([ 'status_code' => 403, 'message' => '非法跨站请求' ] , 403);
    }

    if ($e instanceof Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
        // return Response::json(['status_code' => 404, 'message' => 'model not found' ] , 404);
        $message = '路径错误';

    }

    if ($e instanceof Illuminate\Database\Eloquent\ModelNotFoundException) {
        // return Response::json([ 'status_code' => 404, 'message' => '路径错误' ] , 404);
        $message = 'model not found';
    }

    return View::make('common.views.errors.info');

});


