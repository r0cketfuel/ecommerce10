<?php

    namespace App\Services;

    use MercadoPago\Client\Payment\PaymentClient;
    use MercadoPago\Exceptions\MPApiException;
    use MercadoPago\MercadoPagoConfig;
    use App\Services\PaymentProcessor;

    class MercadoPago extends PaymentProcessor
    {
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function __construct($apiKey)
        {
            parent::__construct($apiKey);

            MercadoPagoConfig::setAccessToken($this->apiKey);
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function charge($request)
        {
            $client = new PaymentClient();

            try
            {
                $payment = $client->create($request);
                
                return $payment;
            }
            catch (MPApiException $e)
            {
                dd("Exception", $e);
                return null;
            }
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function refund($transactionId)
        {
            // Lógica específica de MercadoPago para realizar un reembolso.
            // Implementa la lógica para procesar el reembolso según tus necesidades.
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    }
