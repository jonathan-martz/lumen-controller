<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

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
    public $xxsProtection = ['all' => true];


    /**
     * Controller constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->addRequest('timestamp', \time());
    }

    /**
     * @throws Exception
     */
    public function performXxsProtection()
    {
        if (!empty($this->xxsProtection['all']) && $this->xxsProtection['all'] === true) {
            foreach ($this->request->all() as $key => $input) {
                if (strlen($input) !== strlen(strip_tags($input))) {
                    throw new Exception('Request contains xss attack');
                }
            }
        }
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
     * @param string $key
     * @param $value
     */
    public function addRequest(string $key, $value): void
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
        try{
            $this->performXxsProtection();
        }
        catch(Exception $e){
            $this->resetMessages();
            $this->addMessage('exception', $e->getMessage());
        }
        return response()->json([
            'result' => $this->result,
            'request' => $this->request,
            'message' => $this->message
        ]);
    }
}
