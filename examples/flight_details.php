<?php

require __DIR__ . '/../vendor/autoload.php';

use FlightOperator\FlightDetailsRequest;
use FlightOperator\FlightDetailsResponse;
use FlightOperator\FlightOperatorClient;
use Grpc\ChannelCredentials;


$hostname = $_ENV["FLIGHT_OPERATOR_URL"];
$client = new FlightOperatorClient($hostname, ["credentials" => ChannelCredentials::createInsecure()]);

if (!$client->waitForReady(5000000)) {
    die("not ready");
}

$flightDetailsRequest = new FlightDetailsRequest();
/** @var FlightDetailsResponse $flightDetailsResponse */
list($flightDetailsResponse, $status) = $client->FlightDetails($flightDetailsRequest)->wait();

if ($status->code != \Grpc\STATUS_OK) {
    print_r($status);
    die();
}

print_r($flightDetailsResponse->serializeToJsonString());
