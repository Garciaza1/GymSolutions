<?php

namespace GymSolution\System;
// use Twilio\Http\Client;
use Twilio\Rest\Client;
use Exception;

class Twilio
{
    public function send_sms($number, $token)
    {
        // Substitua com suas credenciais do Twilio
        $accountSid = TWILIO_ID;
        $authToken  = TWILIO_TOKEN;
        $twilioNumber = TWILIO_NUMBER;

        // Número de destino
        $toNumber = $number;

        // Mensagem a ser enviada
        $message = 'Olá! Esta é uma mensagem de teste do Twilio. aqui esta seu codigo:' . $token;

        try {
            // Crie uma instância do cliente Twilio
            $twilio = new Client($accountSid, $authToken);

            // Envie a mensagem
            $twilio->messages->create(
                $toNumber,
                ['from' => $twilioNumber, 'body' => $message]
            );

            return [
                'status' => 'success'
            ];
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }
}
