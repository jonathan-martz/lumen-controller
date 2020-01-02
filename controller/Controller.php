<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use function time;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    /**
     * @var array
     */
    public $result = [];

    /**
     * @var Request
     */
    public $request;
    /**
     * @var array
     */
    public $message = [];

    /**
     * Controller constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->addRequest('timestamp', time());
    }

    /**
     * @param string $key
     * @param $value
     */
    public function addRequest(string $key, $value): void
    {
        $this->result[$key] = $value;
    }

    /**
     * @param string $key
     * @param $value
     */
    public function addResult(string $key, $value): void
    {
        $this->result[$key] = $value;
    }

    /**
     * @param string $status
     * @param string $message
     */
    public function addMessage(string $status, string $message): void
    {
        $this->message[] = [
            'status' => $status,
            'message' => $message
        ];
    }

    /**
     *
     */
    public function resetMessages(): void
    {
        $this->message = [];
    }


    /**
     * @return JsonResponse
     */
    public function getResponse(): JsonResponse
    {
        return response()->json([
            'result' => $this->result,
            'request' => $this->request,
            'message' => $this->message
        ]);
    }
}
