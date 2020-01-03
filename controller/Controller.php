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
     * @var array
     */
    private $allowedStatus = [
        200, 404, 418, 500
    ];

    /**
     * Controller constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->addRequest('timestamp', time());
        $this->addResult('status', 200);
        $this->setRedirect('false');
        $this->setRedirect(false);
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
     * @param string $path
     */
    public function setRedirect(string $path)
    {
        $this->addResult('redirect', $path);
    }

    /**
     * @param bool $reload
     */
    public function setReload(bool $reload)
    {
        $this->addResult('reload', $reload);
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status)
    {
        if(in_array($status, $this->allowedStatus)) {
            $this->addResult('status', $status);
        }
        else {
            $this->addMessage('warning', 'Status not allowed.');
        }
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
