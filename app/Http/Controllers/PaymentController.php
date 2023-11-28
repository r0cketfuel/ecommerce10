<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Services\ShoppingCartService;

    use App\Models\Articulo;
    use App\Models\Factura;
    use App\Models\FacturaDetalle;
    use App\Models\TipoDocumento;

    use App\Services\MercadoPago;

    class PaymentController extends Controller
    {
        private $medioPagoId;
        private $checkout;
        
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        private function getDataFromRequest(Request $request)
        {
            $data = $request->hasHeader("Content-Type") && $request->header("Content-Type") === "application/json"
                ? json_decode(file_get_contents("php://input"), true)
                : $request->all();
        
            return $data;
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        private function prepareItems()
        {
            //dd($this->checkout["items"]);

            $items = $this->checkout["items"];

            // foreach ($this->checkout["items"] as $item) 
            //     $items[] = Articulo::info($item["id"]);

            return $items;
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        private function prepareItemsMp()
        {
            $itemsMp = [];
        
            foreach ($this->checkout["items"] as $item)
            {
                $info = Articulo::info($item["id"]);
        
                $itemsMp[] = [
                    "id"            => $info["id"],
                    "title"         => $info["descripcion"],
                    "description"   => "",
                    "picture_url"   => count($info["imagenes"]) ? $info["imagenes"][0]["miniatura"] : null,
                    "category_id"   => "",
                    "quantity"      => $item["cantidad"],
                    "unit_price"    => $info["precio"],
                ];
            }
        
            return $itemsMp;
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function process_payment(Request $request, ShoppingCartService $shoppingCart)
        {
            $this->medioPagoId  = session("shop.checkout.medio_pago.id");
            $this->checkout     = $shoppingCart->checkOut();

            foreach ($this->checkout["items"] as &$item)
            {
                $articulo = Articulo::info($item["id"]);
        
                $item["descripcion"]    = $articulo->descripcion ?? NULL;
                $item["imagen"]         = count($articulo->imagenes) ? $articulo->imagenes[0]["miniatura"] : NULL;
            }
        
            $items      = $this->prepareItems();
            $itemsMp    = $this->prepareItemsMp();

            //DESCONTAR STOCK
            //$articulo_id = Articulo::where("talle_id", $talle_id)->where("color", $color)["id"];
            //Articulo::modificaStock($articulo_id, $stock - $cantidad);

            $data = $this->getDataFromRequest($request);

            switch($this->medioPagoId)
            {            
                case(1):
                case(2):
                    $this->crearFacturas($data, $items);
                    return redirect("/shop/success");
                    break;

                case(3):
                    $this->debitoCredito($data, $items, $itemsMp);
                    break;

                case(4):
                    $response = $this->pagofacil($data, $items, $itemsMp);
                    return redirect("/shop/success");
                    break;

                case(5):
                    $response = $this->rapipago($data, $items, $itemsMp);
                    return redirect("/shop/success");
                    break;
            }
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function debitoCredito($data, $items, $itemsMp)
        {
            $parametros = array(
                "issuer_id"                 => (int)$data["issuer_id"],
                "description"               => $data["description"],
                "external_reference"        => "Referencia externa",
                "token"                     => $data["token"],
                "installments"              => (int)$data["installments"],
                "payer"                     => array(
                    "email"                 => $data["payer"]["email"],
                    "identification"        => array(
                        "type"              => $data["payer"]["identification"]["type"],
                        "number"            => $data["payer"]["identification"]["number"]
                        )
                ),
                "payment_method_id"         => $data["payment_method_id"],
                "transaction_amount"        => (float)session("shop.checkout.total"),
                "additional_info"           => array(
                    "items"                 => $itemsMp,
                    "payer"                 => array(
                        "first_name"        => $data["apellidos"],
                        "last_name"         => $data["nombres"],
                        "phone"             => array("area_code"=>"11","number"=>"4403698"),
                    ),
                    "shipments"             => array(
                        "receiver_address"  => array(
                            "zip_code"      => "12312-123",
                            "state_name"    => "Rio de Janeiro",
                            "city_name"     => "Buzios",
                            "street_name"   => "Av das Nacoes Unidas",
                            "street_number" => 3003,
                        ),
                    ),
                ),
            );

            $mercadoPago    = new MercadoPago(env('MERCADOPAGO_ACCESS_TOKEN'));
            $response       = $mercadoPago->charge($parametros);

            if($response->status==="approved")
                $this->crearFacturas($data, $items);

            // Respuesta de la api
            echo json_encode($response);
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function pagofacil($data, $items, $itemsMp)
        {
            if($this->medioPagoId==4 || $this->medioPagoId==5)
            {
                if($this->medioPagoId==4) $payment_method_id = "pagofacil";
                if($this->medioPagoId==5) $payment_method_id = "rapipago";

                $parametros = array(
                    "description"               => "Descripción",
                    "external_reference"        => "Referencia externa",
                    "payer"                     => array(
                        "email"                 => $data["email"],
                        "identification"        => array(
                            "type"              => $data["tipo_documento_id"],
                            "number"            => $data["documento_nro"]
                        )
                    ),
                    "payment_method_id"         => $payment_method_id,
                    "transaction_amount"        => (float)session("shop.checkout.total"),
                    "additional_info"           => array(
                        "items"                 => $itemsMp,
                        "payer"                 => array(
                            "first_name"        => $data["apellidos"],
                            "last_name"         => $data["nombres"],
                            "phone"             => array("area_code"=>"11","number"=>"4403698"),
                        ),
                        "shipments"             => array(
                            "receiver_address"  => array(
                                "zip_code"      => "12312-123",
                                "state_name"    => "Rio de Janeiro",
                                "city_name"     => "Buzios",
                                "street_name"   => "Av das Nacoes Unidas",
                                "street_number" => 3003,
                            ),
                        ),
                    ),
                );

                $mercadoPago    = new MercadoPago(env('MERCADOPAGO_ACCESS_TOKEN'));
                $response       = $mercadoPago->charge($parametros);

                $this->crearFacturas($data, $items);
                
                return($response);
            }
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function rapipago($data, $items, $itemsMp)
        {
            if($this->medioPagoId==4 || $this->medioPagoId==5)
            {
                if($this->medioPagoId==4) $payment_method_id = "pagofacil";
                if($this->medioPagoId==5) $payment_method_id = "rapipago";

                $parametros = array(
                    "description"               => "Descripción",
                    "external_reference"        => "Referencia externa",
                    "payer"                     => array(
                        "email"                 => $data["email"],
                        "identification"        => array(
                            "type"              => $data["tipo_documento_id"],
                            "number"            => $data["documento_nro"]
                        )
                    ),
                    "payment_method_id"         => $payment_method_id,
                    "transaction_amount"        => (float)session("shop.checkout.total"),
                    "additional_info"           => array(
                        "items"                 => $itemsMp,
                        "payer"                 => array(
                            "first_name"        => $data["apellidos"],
                            "last_name"         => $data["nombres"],
                            "phone"             => array("area_code"=>"11","number"=>"4403698"),
                        ),
                        "shipments"             => array(
                            "receiver_address"  => array(
                                "zip_code"      => "12312-123",
                                "state_name"    => "Rio de Janeiro",
                                "city_name"     => "Buzios",
                                "street_name"   => "Av das Nacoes Unidas",
                                "street_number" => 3003,
                            ),
                        ),
                    ),
                );

                $mercadoPago    = new MercadoPago(env('MERCADOPAGO_ACCESS_TOKEN'));
                $response       = $mercadoPago->charge($parametros);

                $this->crearFacturas($data, $items);

                return($response);
            }
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function crearFacturas($fields, $items)
        {
            //======================================================//
            // Método que crea la factura y el detalle de la compra //
            //======================================================//

            // Solución al cambio atributo 'value' que modifica el script de mercadopago
            if(!is_numeric($fields["tipo_documento_id"]))
                $tipoDocumentoId = TipoDocumento::search($fields["tipo_documento_id"])["id"];
            else
                $tipoDocumentoId = $fields["tipo_documento_id"];

            // Creación de la factura
            $factura = Factura::generarFactura([
                "fecha"             => now(),
                "numero"            => rand(100,999),
                "tipo_factura_id"   => 1,
                "apellidos"         => $fields["apellidos"],
                "nombres"           => $fields["nombres"],
                "tipo_documento_id" => $tipoDocumentoId,
                "documento_nro"     => $fields["documento_nro"],
                "domicilio"         => $fields["domicilio"],
                "domicilio_nro"     => $fields["domicilio_nro"],
                "domicilio_piso"    => $fields["domicilio_piso"],
                "domicilio_depto"   => $fields["domicilio_depto"],
                "localidad"         => $fields["localidad"],
                "codigo_postal"     => $fields["codigo_postal"],
                "total"             => session("shop.checkout.total"),
                "medio_pago_id"     => session("shop.checkout.medio_pago.id"),
                "medio_envio_id"    => session("shop.checkout.medio_envio.id"),
                "cae"               => "",
                "cae_vto"           => "2099-01-01",
                "estado_id"         => 1,
            ]);

            // Creación del detalle de la factura
            for($i=0;$i<count($items);$i++)
            {
                $articulo = Articulo::info($items[$i]["id"]);

                FacturaDetalle::generarDetalle([
                    "factura_id"        => $factura->id,
                    "articulo_id"       => $articulo->id,
                    "precio"            => $articulo->precio,
                    "cantidad"          => $items[$i]["cantidad"],
                    "subtotal"          => (float)$articulo->precio * $items[$i]["cantidad"]
                ]);
            }
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    }
