<?php

namespace Artcustomer\GeminiClient\Connector;

use Artcustomer\ApiUnit\Client\AbstractApiClient;
use Artcustomer\ApiUnit\Connector\AbstractConnector;
use Artcustomer\ApiUnit\Http\IApiResponse;
use Artcustomer\ApiUnit\Utils\ApiMethodTypes;
use Artcustomer\GeminiClient\Http\ModelRequest;

/**
 * @author David
 */
class ModelConnector extends AbstractConnector
{

    public const PARAM_PAGESIZE = 'pageSize';
    public const PARAM_PAGETOKEN = 'pageToken';

    /**
     * Constructor
     *
     * @param AbstractApiClient $client
     */
    public function __construct(AbstractApiClient $client)
    {
        parent::__construct($client, false);
    }

    /**
     * List models
     *
     * @return IApiResponse
     */
    public function list(): IApiResponse
    {
        $data = [
            'method' => ApiMethodTypes::GET,
            'query' => [
                self::PARAM_PAGESIZE => 1000,
            ]
        ];
        $request = $this->client->getRequestFactory()->instantiate(ModelRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }
}