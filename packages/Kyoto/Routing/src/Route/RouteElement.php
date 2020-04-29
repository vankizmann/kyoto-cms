<?php

namespace Kyoto\Routing\Route;

use Illuminate\Support\Facades\Request;

class RouteElement
{
    protected $server;

    protected $matches;

    public function __construct($server = null)
    {
        $this->server = $server ?: Request::fullUrl();

        preg_match('/^(https?)\:\/\/(.*?)(\/.*?)?(\?.*?)?$/',
            strtolower($this->server), $this->matches);
    }

    public function getHttp()
    {
        return trim(@$this->matches[1], '/') ?: null;
    }

    public function getHost()
    {
        return trim(@$this->matches[2], '/') ?: null;
    }

    public function getPath()
    {
        return trim(@$this->matches[3], '/') ?: null;
    }

    public function getQuery()
    {
        return trim(@$this->matches[4], '?') ?: null;
    }

    public function getMethod()
    {
        return strtolower(Request::method() ?: 'cli');
    }

    public function getFullUrl()
    {
        return $this->server;
    }

    public function getSegments($limit = null)
    {
        $segments = explode('/', $this->getPath());

        $segments = array_filter($segments);

        if ( $limit < 0 ) {
            $limit = count($segments) + $limit;
        }

        return array_slice($segments, 0, $limit);
    }

    public function getSegment($index = 0)
    {
        $segments = $this->getSegments();

        if ( $index < 0 ) {
            $index = count($segments) + $index;
        }

        return data_get($segments, $index);
    }

    public function getParams()
    {
        parse_str($this->getQuery(), $params);

        return $params;
    }

}
