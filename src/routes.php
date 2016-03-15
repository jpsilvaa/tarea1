<?php
// Routes
$app->post('/validarFirma', function ($request, $response, $args) {
    // Sample log message
//    $this->logger->info("Slim-Skeleton '/' route");

	if(!isset($_POST["mensaje"]) || !isset($_POST["hash"]) ){
		$newresponse =  $response->withStatus(400);
		return $newresponse;
	}
	$valido = false;
	$mensaje = $_POST["mensaje"];
	$firma = $_POST["hash"];

	$firma2 = hash('sha256', $mensaje);

	if(strtolower($firma) == strtolower($firma2)) {  $valido = true; }
	echo json_encode(array("mensaje"=> $mensaje, "valido" =>$valido));
    // Render index view
//    return $this->renderer->render($response, 'index.phtml', $args);
});

 $app->get('/status', function ($request, $response, $args) {
	$newresponse =  $response->withStatus(201);
	return $newresponse;

});


$app->get('/texto', function ($request, $response, $args) {
    // Sample log message
		$mensaje = 	file_get_contents('https://s3.amazonaws.com/files.principal/texto.txt');
		$firma = hash('sha256', $mensaje);

		echo json_encode(array("mensaje" => $mensaje, "firma" => $firma));
});
