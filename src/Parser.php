<?php

namespace HeaderParser;

class Parser
{
    private $rawHeaders;
    private $parsedHeaders = null;

    public function __construct(array $rawHeaders)
    {
        $this->rawHeaders = $rawHeaders;
    }

    private function parseHeaders()
    {
        $headers = $this->rawHeaders;

        foreach ($headers as $header) {
            $headerParts = explode(':', $header);
            if ('HTTP' === substr($headerParts[0], 0, 4)) {
                list(, $this->parsedHeaders['status'], $this->parsedHeaders['statusmessage']) =
                    explode(' ', $headerParts[0]);
                continue;
            }
            $this->parsedHeaders[strtolower($headerParts[0])] = $headerParts[1];
        }
    }

    public function getHeaderValue($key)
    {
        if (is_null($this->parsedHeaders)) {
            $this->parseHeaders();
        }
        if (isset($this->parsedHeaders[strtolower($key)])) {
            return $this->parsedHeaders[strtolower($key)];
        }
    }

    public function getHttpStatus()
    {
        return $this->getHeaderValue('status');
    }

    public function getHttpMessage()
    {
        return $this->getHeaderValue('statusmessage');
    }
}
