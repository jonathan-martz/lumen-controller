<?php

	namespace App\Http\Controllers;

	use \Illuminate\Http\Request;
	use \Laravel\Lumen\Routing\Controller as BaseController;

	class Controller extends BaseController
	{
		public $result =  [];
		public $request = [];
		public $message = [];

		public function __construct(){
			$this->addRequest('timestamp',\time());
		}

		public function addResult(string $key, $value):void{
			$this->result[$key] = $value;
		}

		public function addRequest(string $key, $value):void{
			$this->result[$key] = $value;
		}

		public function addMessage(string $status, string $message):void{
			$this->message[] = [
				'status' => $status,
				'message' => $message
			];
		}

		public function resetMessages():void{
			$this->message[] = [];
		}

		public function getResponse(){
			return response()->json([
				'result' => $this->result,
				'request' => $this->request,
				'message' => $this->message
			]);
		}
	}
