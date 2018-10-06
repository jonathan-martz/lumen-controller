<?php

	namespace App\Http\Controllers;

	use \Illuminate\Http\Request;
	use \Laravel\Lumen\Routing\Controller as BaseController;

	class Controller extends BaseController
	{

		public $result =  [];
		public $request =  [];

		public function addResult(string $key, $value):void{
			$this->result[$key] = $value;
		}

		public function addRequest(string $key, $value):void{
			$this->result[$key] = $value;
		}

		public function getResponse(){
			return response()->json([
				'result' => $this->result,
				'request' => $this->request
			]);
		}
	}
