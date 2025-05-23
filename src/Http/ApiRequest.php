<?php

namespace Artcustomer\GeminiClient\Http;

use Artcustomer\ApiUnit\Http\CurlApiRequest;

/**
 * @author David
 */
class ApiRequest extends CurlApiRequest
{

    private string $protocol;
    private string $host;
    private string $version;
    private string $apiKey;
    protected string $uriBase;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->secured = true;
    }

    /**
     * Setup request
     *
     * @param array $apiParams
     * @return void
     */
    public function setup(array $apiParams): void
    {
        if (array_key_exists('protocol', $apiParams)) {
            $this->protocol = $apiParams['protocol'];
        }

        if (array_key_exists('host', $apiParams)) {
            $this->host = $apiParams['host'];
        }

        if (array_key_exists('version', $apiParams)) {
            $this->version = $apiParams['version'];
        }

        if (array_key_exists('api_key', $apiParams)) {
            $this->apiKey = $apiParams['api_key'];
        }

        $this->uriBase = sprintf('%s%s/%s', $this->protocol, $this->host, $this->version);
    }

    /**
     * PreExecute callback
     *
     * @return void
     */
    public function preExecute(): void
    {
        $this->body = json_encode($this->body);
    }

    /**
     * PostExecute callback
     *
     * @return void
     */
    public function postExecute(): void
    {

    }

    /**
     * Build options
     *
     * @return void
     */
    protected function buildOptions(): void
    {
        $this->options[CURLOPT_SSL_VERIFYHOST] = 0;
        $this->options[CURLOPT_SSL_VERIFYPEER] = 0;
        $this->options[CURLOPT_HEADER] = 0;
        $this->options[CURLOPT_ENCODING] = '';
        $this->options[CURLOPT_RETURNTRANSFER] = 1;
        $this->options[CURLOPT_FOLLOWLOCATION] = 1;
        $this->options[CURLOPT_MAXREDIRS] = 10;
        $this->options[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_1;
    }

    /**
     * Build headers
     *
     * @return void
     */
    protected function buildHeaders(): void
    {
        $this->headers['Content-Type'] = 'application/json';
    }

    /**
     * Build Uri
     *
     * @return void
     */
    protected function buildUri(): void
    {
        $this->uri = sprintf('%s/%s', $this->uriBase, $this->endpoint);
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        $query = [
            'key' => $this->apiKey
        ];

        $this->query = array_merge(
            $this->query ?? [],
            $query
        );

        return parent::getUri();
    }
}
