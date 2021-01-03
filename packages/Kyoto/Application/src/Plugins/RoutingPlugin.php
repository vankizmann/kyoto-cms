<?php

namespace Kyoto\Application\Plugins;

use Kyoto\Support\Routing\UrlGenerator;

trait RoutingPlugin
{
    public $protocol;

    public $domain;

    /**
     * Register collection plugin
     *
     * @return void
     */
    public function registerRoutingPlugin()
    {
        app()->extend('url', function () {
            return new UrlGenerator(app('routes'), app('request'));
        });
    }

    public function setProtocol($protocol)
    {
        return $this->protocol = preg_match('/https/', $protocol) ?
            'https' : 'http';
    }

    public function getProtocol()
    {
        if ( empty($this->domain) ) {
            return $this->setProtocol(config('app.url'));
        }

        return $this->protocol;
    }

    public function hasProtocol()
    {
        return ! empty($this->protocol);
    }

    public function setDomain($domain)
    {
        return $this->domain = preg_replace('/^https?\:\/\//', '', $domain);
    }

    public function getDomain()
    {
        if ( empty($this->domain) ) {
            return $this->setDomain(config('app.url'));
        }

        return $this->domain;
    }

    public function hasDomain()
    {
        return ! empty($this->domain);
    }

}
