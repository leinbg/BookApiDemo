<?php

namespace App\Http\Controllers;

/**
 * Class ApiController
 *
 * @package App\Http\Controllers
 */
class ApiController extends Controller
{

    /**
     * @var int
     */
    protected $status = 200;

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function responseSuccess($data)
    {
        $data = ['data' => $data];
        return $this->setStatus(200)->response($data);
    }



    /**
     * @param string $message
     *
     * @return mixed
     */
    public function responseError($message = 'not Found')
    {
        return $this->setStatus(404)->responseWithError($message);
    }

    /**
     * @param $message
     *
     * @return mixed
     */
    protected function responseWithError($message)
    {
        return $this->response([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatus(),
            ]
        ]);
    }

    /**
     * @param $data
     * @param array $header
     *
     * @return mixed
     */
    protected function response($data, $header = [])
    {
        return response()->json($data, $this->getStatus(), $header);
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status status
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}