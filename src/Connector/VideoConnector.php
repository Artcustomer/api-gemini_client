<?php

namespace Artcustomer\GeminiClient\Connector;

use Artcustomer\ApiUnit\Client\AbstractApiClient;
use Artcustomer\ApiUnit\Connector\AbstractConnector;
use Artcustomer\ApiUnit\Http\IApiResponse;
use Artcustomer\ApiUnit\Utils\ApiMethodTypes;
use Artcustomer\GeminiClient\Http\ApiRequest;
use Artcustomer\GeminiClient\Http\ModelRequest;
use Artcustomer\GeminiClient\Utils\ApiEndpoints;

/**
 * @author David
 */
class VideoConnector extends AbstractConnector
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
     * Generate video
     *
     * @param string $model
     * @param array $params
     * @return IApiResponse
     */
    public function generate(string $model, array $params = []): IApiResponse
    {
        $data = [
            'method' => ApiMethodTypes::POST,
            'endpoint' => sprintf('%s:%s', $model, ApiEndpoints::PREDICT_LONG_RUNNING),
            'body' => $params
        ];
        $request = $this->client->getRequestFactory()->instantiate(ModelRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }

    /**
     * @param string $name
     * @return IApiResponse
     */
    public function getOperation(string $name): IApiResponse
    {
        $data = [
            'method' => ApiMethodTypes::GET,
            'endpoint' => $name
        ];
        $request = $this->client->getRequestFactory()->instantiate(ApiRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }

    /**
     * @param string $uri
     * @return IApiResponse
     */
    public function download(string $uri)
    {
        $data = [
            'method' => ApiMethodTypes::GET
        ];
        $request = $this->client->getRequestFactory()->instantiate(ApiRequest::class, [$data]);

        if ($request instanceof ApiRequest) {
            $request->setUri($uri);
        }

        return $this->client->executeRequest($request);
    }
}