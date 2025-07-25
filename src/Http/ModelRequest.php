<?php

namespace Artcustomer\GeminiClient\Http;

use Artcustomer\GeminiClient\Utils\ApiEndpoints;

/**
 * @author David
 */
class ModelRequest extends ApiRequest
{

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * Build Uri
     *
     * @return void
     */
    protected function buildUri(): void
    {
        $this->uri = sprintf('%s/%s', $this->uriBase, ApiEndpoints::MODELS);

        if (!empty($this->endpoint)) {
            $this->uri = sprintf('%s/%s', $this->uri, $this->endpoint);
        }
    }
}
