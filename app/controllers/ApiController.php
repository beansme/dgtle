<?php

class ApiController extends \BaseController {

	
	protected $statusCode = 200;

	/**
	 * @return mixed
	 */
	public function getStatusCode()
	{
	    return $this->statusCode;
	}

	/**
	 * @param mixed $statusCode
	 * @return $this
	 */
	public function setStatusCode($statusCode)
	{
	    $this->statusCode = $statusCode;
	    return $this;
	}

	/**
	 * @param string $message
	 * @return mixed
	 */
	public function respondNotFound($message = 'not found')
	{

	    return $this->setStatusCode(404)->respondWithError($message);

	}

	public function respondLogicError($message = '业务错误')
	{
	    return $this->setStatusCode(300)->respondWithError($message);
	}

	/**
	 * @param $data
	 * @param array $header
	 * @return mixed
	 */
	public function respond($data, $header = [])
	{
	    $opt = ['status_code' => $this->getStatusCode(), 'message' => ''];
	    return Response::json(array_merge($opt, $data), $this->getStatusCode(), $header);
	}

	public function respondCreated($message = "创建成功")
	{
	    return $this->setStatusCode(200)->respond(['data' => $message]);
	}

	public function respondData($data)
	{
	    return $this->setStatusCode(200)->respond(['data' => $data]);
	}

	public function respondOk($message = 'success')
	{
	    return $this->setStatusCode(200)->respond(['data' => ['message' => $message]]);
	}


	/**
	 * @param $message
	 * @return mixed
	 */
	public function respondWithError($message)
	{
			$this->setStatusCode(400);
	    return Response::json(array(

	        'status_code' => $this->getStatusCode(),
	        'message' => $message

	    ));
	}


}