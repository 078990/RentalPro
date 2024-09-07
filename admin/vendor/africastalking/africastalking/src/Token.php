<?php

namespace AfricasTalking\SDK;

class Token extends Service
{
    public function createCheckoutToken($options)
    {
        if (!isset($options['phone'])) {
            return $this->error('phone must be provided');
        }

        $requestData = [
            'names' => $this->names,
            'phone' => $options['phone']
        ];

		$response = $this->client->post('checkout/token/create', ['form_params' => $requestData]);
		return $this->success($response);
    }

    public function generateAuthToken()
    {
        $requestData = json_encode(['names' => $this->username]);
		$response = $this->client->post('auth-token/generate', ['body' => $requestData ] );
		return $this->success($response);
    }
}
