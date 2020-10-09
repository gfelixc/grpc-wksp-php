<?php

require __DIR__ . '/../vendor/autoload.php';

use FlightOperator\DeparturesRequest;
use FlightOperator\DeparturesResponse;
use FlightOperator\FlightOperatorClient;
use FlightOperator\SupportChatRequest;
use FlightOperator\SupportChatResponse;
use FlightOperator\TravelUpdatesRequest;
use Grpc\ChannelCredentials;
use Grpc\ClientStreamingCall;
use Grpc\ServerStreamingCall;


$hostname = $_ENV["FLIGHT_OPERATOR_URL"];
$client = new FlightOperatorClient($hostname, ["credentials" => ChannelCredentials::createInsecure()]);

if (!$client->waitForReady(5000000)) {
    die("not ready");
}


/** @var \Grpc\BidiStreamingCall $stream */
$stream = $client->SupportChat();


for ($i = 0; $i <= 5; $i++) {
    if (!$client->getConnectivityState()) {
        die("disconnected");
    }

    $request = new SupportChatRequest();
    $request->setTravelerId("Jack Swigert");
    $request->setMessage("Houston, we've had a problem here.");
    $stream->write($request);

    /** @var SupportChatResponse $response */
    $response = $stream->read();
    print_r($response->serializeToJsonString());
}

$stream->cancel();