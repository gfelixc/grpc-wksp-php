<?php

require __DIR__ . '/../vendor/autoload.php';

use FlightOperator\DeparturesRequest;
use FlightOperator\DeparturesResponse;
use FlightOperator\FlightOperatorClient;
use Grpc\ChannelCredentials;
use Grpc\ServerStreamingCall;


$hostname = $_ENV["FLIGHT_OPERATOR_URL"];
$client = new FlightOperatorClient($hostname, ["credentials" => ChannelCredentials::createInsecure()]);

if (!$client->waitForReady(5000000)) {
    die("not ready\n");
}

$request = new DeparturesRequest();

/** @var ServerStreamingCall $stream */
$stream = $client->Departures($request);

/** @var DeparturesResponse $response */
foreach ($stream->responses() as $response) {
    print_r($response->serializeToJsonString());
}
