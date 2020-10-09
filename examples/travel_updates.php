<?php

require __DIR__ . '/../vendor/autoload.php';

use FlightOperator\DeparturesRequest;
use FlightOperator\DeparturesResponse;
use FlightOperator\FlightOperatorClient;
use FlightOperator\TravelUpdatesRequest;
use Grpc\ChannelCredentials;
use Grpc\ClientStreamingCall;
use Grpc\ServerStreamingCall;


$hostname = $_ENV["FLIGHT_OPERATOR_URL"];
$client = new FlightOperatorClient($hostname, ["credentials" => ChannelCredentials::createInsecure()]);

if (!$client->waitForReady(5000000)) {
    die("not ready");
}


/** @var ClientStreamingCall $stream */
$stream = $client->TravelUpdates();

for ($i = 0; $i <= 5; $i++) {
    if (!$client->getConnectivityState()) {
        die("disconnected");
    }

    $request = new TravelUpdatesRequest();
    $request->setId("ID!@#$!");
    $request->setLastStatus($i);
    $stream->write($request);
    sleep(2);
}

/** @var DeparturesResponse $response */
list($response, $status) = $stream->wait();
print_r($response->serializeToJsonString());