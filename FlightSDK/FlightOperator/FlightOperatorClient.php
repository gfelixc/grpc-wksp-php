<?php
// GENERATED CODE -- DO NOT EDIT!

namespace FlightOperator;

/**
 */
class FlightOperatorClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \FlightOperator\FlightDetailsRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \FlightOperator\FlightDetailsResponse
     */
    public function FlightDetails(\FlightOperator\FlightDetailsRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/FlightOperator/FlightDetails',
        $argument,
        ['\FlightOperator\FlightDetailsResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \FlightOperator\DeparturesRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \FlightOperator\DeparturesResponse
     */
    public function Departures(\FlightOperator\DeparturesRequest $argument,
      $metadata = [], $options = []) {
        return $this->_serverStreamRequest('/FlightOperator/Departures',
        $argument,
        ['\FlightOperator\DeparturesResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param array $metadata metadata
     * @param array $options call options
     * @return \FlightOperator\TravelUpdatesResponse
     */
    public function TravelUpdates($metadata = [], $options = []) {
        return $this->_clientStreamRequest('/FlightOperator/TravelUpdates',
        ['\FlightOperator\TravelUpdatesResponse','decode'],
        $metadata, $options);
    }

    /**
     * @param array $metadata metadata
     * @param array $options call options
     * @return \FlightOperator\SupportChatResponse
     */
    public function SupportChat($metadata = [], $options = []) {
        return $this->_bidiRequest('/FlightOperator/SupportChat',
        ['\FlightOperator\SupportChatResponse','decode'],
        $metadata, $options);
    }

}
