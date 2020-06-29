<?php 
error_reporting(-1);
	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE,OPTIONS');
	
   
	$data=json_decode(file_get_contents("php://input"),true);

	if ((strlen($data['Envio']['metodo']) > 5) && (count($data['Productos']) > 0) && (count($data['Pedido']) > 13)) 
	{
		require 'mp/vendor/autoload.php';

		// Agrega credenciales
		MercadoPago\SDK::setAccessToken('TEST-633745925553658-051611-eb9797460c877042e2cf0920c8d88c06-569072434');

		$items= array();
		// Crea un array de �tems en la preferencia
		foreach ($data['Productos'] as $producto) 
		{
			
		
        	$items[]= array
            	(
               		"title"			=>	$producto['nombre'],
                    "quantity"		=>	(int)$producto['cantidad'],
                    "currency_id"	=>	"ARS",
                    "unit_price"	=>	(float)$producto['precio'],
                    "id"			=>	(int)$producto['id'],
                    "description"	=>	$producto['descripcion'],
                    "picture_url"	=>	$producto['imagen']
                );
        	}
		
         // ...
		  $payer = new MercadoPago\Payer();
		  $payer->name = $data['Pedido']['nombre'];
		  $payer->surname = $data['Pedido']['apellido'];
		  $payer->email = $data['Pedido']['email'];
		  $payer->phone = array(
		    "area_code" => "",
		    "number" => $data['Pedido']['telefono']
		  );
		  $payer->identification = array(
		    "type" => "DNI",
		    "number" => $data['Pedido']['cuitCuilDni']
		  );
		  $payer->address = array(
		    "street_name" => $data['Pedido']['direccion'],
		    "street_number" => $data['Pedido']['numero'],
		    "zip_code" => $data['Pedido']['codigoPostal']
		  );
		  // ...

		// Crea un objeto de preferencia
		$preference = new MercadoPago\Preference();
		$preference->back_urls = array(
		    "success" => "localhost/nucleo/model/cobro.php?chkt=go",
		    "failure" => "localhost/nucleo/model/cobro.php?chkt=stp",
		    "pending" => "localhost/nucleo/model/cobro.php?chkt=std"
		);
		

		if ($data['Envio']['metodo'] == "mercadoEnvio") 
		{
			//Dados do Frete
			$shipments = new MercadoPago\ Shipments();
			$shipments->cost = $data['Envio']['costo'];
			$shipments->receiver_address = array(
				"zip_code" => $data['Pedido']['codigoPostal'],
				"street_number" => $data['Pedido']['numero'], 
				"street_name" => $data['Pedido']['direccion'],
				"floor" => 0,
				"apartment" => ""
			);	# code...
		}
		

		$preference->payment_methods = array(
		    "excluded_payment_types" => array(
		    array("id" => "ticket")
		  ),
		  "installments" => 12
		);

		$preference->external_reference = gethostname();
		$preference->auto_return = "approved";
		$preference->binary_mode = true;
		$preference->payer = $payer; 
		$preference->items = $items;
		if ($data['Envio']['metodo'] == "mercadoEnvio") $preference->shipments= $shipments;
		$preference->save();
		
	}
	 
 ?>
    
	<a class="btn btn-success"href="<?php echo $preference->init_point; ?>">Pagar</a> con Mercado Pago
	


