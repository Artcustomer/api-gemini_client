<?php

namespace Artcustomer\GeminiClient\Connector;

use Artcustomer\ApiUnit\Client\AbstractApiClient;
use Artcustomer\ApiUnit\Connector\AbstractConnector;
use Artcustomer\ApiUnit\Http\IApiResponse;
use Artcustomer\ApiUnit\Utils\ApiMethodTypes;
use Artcustomer\GeminiClient\Http\ModelRequest;
use Artcustomer\GeminiClient\Utils\ApiEndpoints;

/**
 * @author David
 */
class TextConnector extends AbstractConnector
{

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
     * Generate text output
     *
     * @param string $model
     * @param array $params
     * @return IApiResponse
     */
    public function generate(string $model, array $params = []): IApiResponse
    {
        $data = [
            'method' => ApiMethodTypes::POST,
            'endpoint' => sprintf('%s:%s', $model, ApiEndpoints::GENERATE_CONTENT),
            'body' => $params
        ];
        $request = $this->client->getRequestFactory()->instantiate(ModelRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }
}