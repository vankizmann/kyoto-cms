<?php

namespace Kyoto\Routing\Reflection;

use Illuminate\Support\Str;
use Kyoto\Routing\Route\RouteElement;

class ReflectionElement
{
    protected $routeElement;

    protected $className;

    protected $methodName;

    protected $reflectionClass;


    public function __construct(RouteElement $url)
    {
        $this->routeElement = $url;

        $this->className = $this->parseRouteClassName();
        $this->methodName = $this->parseRouteMethodName();
    }

    public function parseRouteClassName()
    {
        $segments = $this->routeElement->getSegments(-1);

        $segments = array_map(function ($segment) {
            return Str::studly($segment);
        }, $segments);

        return implode('\\', $segments) . 'Controller';
    }

    public function parseRouteMethodName()
    {
        $segment = Str::studly($this->routeElement->getSegment(-1));

        $methods = $this->getSelfMethods();

        $methodName = lcfirst($segment);

        if ( in_array($methodName, $methods) ) {
            return $this->methodName = $methodName;
        }

        $methodName = $this->routeElement->getMethod() . ucfirst($segment);

        if ( in_array($methodName, $methods) ) {
            return $this->methodName = $methodName;
        }

        return null;
    }

    public function getParsed()
    {
        if ( empty($this->methodName) ) {
            return null;
        }

        return "{$this->className}@{$this->methodName}";
    }

    public function getClassName()
    {
        return $this->className;
    }

    public function getBaseName($suffix = '')
    {
        $quotedSuffix = preg_quote($suffix);

        return preg_replace("#^.*?\\\([^\\\]+){$quotedSuffix}#", '$1', $this->className);
    }

    public function getReflectionClass()
    {
        if ( ! $this->reflectionClass ) {
            $this->reflectionClass = new \ReflectionClass($this->getClassName());
        }

        return $this->reflectionClass;
    }

    public function getSelfReflectionMethods()
    {
        if ( ! class_exists($this->className) ) {
            return [];
        }

        $reflectionMethods = $this->getReflectionClass()
            ->getMethods(\ReflectionMethod::IS_PUBLIC);

        return array_filter($reflectionMethods, function ($method) {
            return $method->class === $this->getClassName();
        });
    }

    public function getSelfMethods($filterCallback = null)
    {
        if ( ! class_exists($this->className) ) {
            return [];
        }

        $methods = array_map(function ($method) {
            return $method->name;
        }, $this->getSelfReflectionMethods());

        if ( $filterCallback ) {
            $methods = array_filter($methods, $filterCallback);
        }

        return $methods;
    }

}
