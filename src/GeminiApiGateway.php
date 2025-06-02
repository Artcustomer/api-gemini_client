<?php

namespace Artcustomer\GeminiClient;

use Artcustomer\ApiUnit\Gateway\AbstractApiGateway;
use Artcustomer\ApiUnit\Http\IApiResponse;
use Artcustomer\GeminiClient\Client\ApiClient;
use Artcustomer\GeminiClient\Connector\AudioConnector;
use Artcustomer\GeminiClient\Connector\ImageConnector;
use Artcustomer\GeminiClient\Connector\ModelConnector;
use Artcustomer\GeminiClient\Connector\TextConnector;
use Artcustomer\GeminiClient\Connector\VideoConnector;
use Artcustomer\GeminiClient\Utils\ApiInfos;

/**
 * @author David
 */
class GeminiApiGateway extends AbstractApiGateway
{

    private AudioConnector $audioConnector;
    private ImageConnector $imageConnector;
    private ModelConnector $modelConnector;
    private TextConnector $textConnector;
    private VideoConnector $videoConnector;

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
     * Get AudioConnector instance
     *
     * @return AudioConnector
     */
    public function getAudioConnector(): AudioConnector
    {
        return $this->audioConnector;
    }

    /**
     * Get ImageConnector instance
     *
     * @return ImageConnector
     */
    public function getImageConnector(): ImageConnector
    {
        return $this->imageConnector;
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
     * Get TextConnector instance
     *
     * @return TextConnector
     */
    public function getTextConnector(): TextConnector
    {
        return $this->textConnector;
    }

    /**
     * Get VideoConnector instance
     *
     * @return VideoConnector
     */
    public function getVideoConnector(): VideoConnector
    {
        return $this->videoConnector;
    }

    /**
     * Setup connectors
     *
     * @return void
     */
    private function setupConnectors(): void
    {
        $this->audioConnector = new AudioConnector($this->client);
        $this->imageConnector = new ImageConnector($this->client);
        $this->modelConnector = new ModelConnector($this->client);
        $this->textConnector = new TextConnector($this->client);
        $this->videoConnector = new VideoConnector($this->client);
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
