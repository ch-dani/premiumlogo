<?php

	namespace App\Traits;

	trait FormatResponse
	{
		protected function formatResponse($status, $message = null, $data = null)
		{
			return [
				'status' => $status,
				'message' => $message,
				'data' => $data,
			];
		}
	}