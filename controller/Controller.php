<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use function time;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    /**
     * @var Request
     */
    public $request;
    /**
     * @var
     */
    public $data = [
        'status' => 200,
        'redirect' => false,
        'reload' => false
    ];

    /**
     * Controller constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->setTimestamp(time());
    }

    public function setTimestamp(int $unix)
    {
        $this->data['timestamp'] = $unix;
    }

    public function setStatus(int $status)
    {
        $this->data['status'] = $status;
    }

    public function setRedirect(?string $url)
    {
        $this->data['redirect'] = $url;
    }

    public function setReload(bool $reload)
    {
        $this->data['reload'] = $reload;
    }

    /**
     * @param string $status
     * @param string $message
     */
    public function addMessage(string $status, string $message): void
    {
        $this->data['message'][] = [
            'status' => $status,
            'message' => $message
        ];
    }

    /**
     * @param string $key
     * @param $value
     */
    public function addData(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    /**
     * @return JsonResponse
     */
    public function getResponse(): JsonResponse
    {
        return response()->json($this->data);
    }
}
