<?php

namespace HeaderParser;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->rawHeaders = [
            'HTTP/1.1 200 OK',
            'Date: Thu, 14 Oct 2010 09:46:18 GMT',
            'Server: Apache/2.2',
            'Last-Modified: Sat, 07 Feb 2009 16:31:04 GMT',
            'ETag: "340011c-3614-46256a9e66200"',
            'Accept-Ranges: bytes',
            'Content-Length: 13844',
            'Vary: User-Agent',
            'Expires: Thu, 15 Apr 2020 20:00:00 GMT',
            'Connection: close',
            'Content-Type: image/png'
        ];
        $this->parser = new Parser($this->rawHeaders);
    }

    public function testGetHeaderValue()
    {
        $this->assertEquals('13844', $this->parser->getHeaderValue('Content-Length'));
    }

    public function testGetHeaderValueWithWierdCasing()
    {
        $this->assertEquals('13844', $this->parser->getHeaderValue('ContENt-LENGth'));
    }

    public function testGetHttpStatusCode()
    {
        $this->assertEquals('200', $this->parser->getHeaderValue('status'));
        $this->assertEquals('200', $this->parser->getHttpStatus());
    }

    public function testGetHttpStatus()
    {
        $this->assertEquals('OK', $this->parser->getHeaderValue('statusMessage'));
        $this->assertEquals('OK', $this->parser->getHttpMessage());
    }
}
