<?php

namespace Artcustomer\GeminiClient;

use Artcustomer\ApiUnit\Gateway\AbstractApiGateway;
use Artcustomer\ApiUnit\Http\IApiResponse;
use Artcustomer\GeminiClient\Client\ApiClient;
use Artcustomer\GeminiClient\Connector\ModelConnector;
use Artcustomer\GeminiClient\Utils\ApiInfos;

/**
 * @author David
 */
class GeminiApiGateway extends AbstractApiGateway
{

    private ModelConnector $modelConnector;

    private string $apiKey;
    private bool $availability;

    /**
     * Constructor
     *
     * @param string $apiKey
     * @param bool $availability
     * @throws \ReflectionException
     */
    public function __construct(string $apiKey, bool $availability)
    {
        $this->apiKey = $apiKey;
        $this->availability = $availability;

        $this->defineParams();

        parent::__construct(ApiClient::class, [$this->params]);
    }

    /**
     * Initialize
     *
     * @return void
     */
    public function initialize(): void
    {
        $this->setupConnectors();

        $this->client->initialize();
    }

    /**
     * Test API
     *
     * @return IApiResponse
     */
    public function test(): IApiResponse
    {
        return $this->modelConnector->list();
    }

    /**
     * Get ModelConnector instance
     *
     * @return ModelConnector
     */
    public function getModelConnector(): ModelConnector
    {
        return $this->modelConnector;
    }

    /**
     * Setup connectors
     *
     * @return void
     */
    private function setupConnectors(): void
    {
        $this->modelConnector = new ModelConnector($this->client);
    }

    /**
     * Define parameters
     *
     * @return void
     */
    private function defineParams(): void
    {
        $this->params['api_name'] = ApiInfos::API_NAME;
        $this->params['api_version'] = ApiInfos::API_VERSION;
        $this->params['protocol'] = ApiInfos::PROTOCOL;
        $this->params['host'] = ApiInfos::HOST;
        $this->params['version'] = ApiInfos::VERSION;
        $this->params['api_key'] = $this->apiKey;
        $this->params['availability'] = $this->availability;
    }
}
