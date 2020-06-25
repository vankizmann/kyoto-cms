<?php

namespace Kyoto\Routing\Route;

use Illuminate\Support\Arr;

class RouteHelper
{
    public static function getRequestUri()
    {
        return isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    }

    public static function makeResourceName($name)
    {
        return preg_replace('/\.[^\.]+$/', '', $name);
    }

    public static function makeLocalizedName($name, $locale = '', $prefix = '')
    {
        $prefix = str_replace('::', '.', $prefix);

        return str_join('.', $locale, $prefix, ...explode('.', $name));
    }

    public static function makeLocalizedRoute($name, $locale = '', $prefix = '')
    {
        $prefix = str_replace('::', '/', $prefix);

        return str_join('/', $locale, $prefix, ...explode('.', $name));
    }

    public static function findLocale($route, $glue = '/')
    {
        $locales = self::findLocales($route, $glue);

        return reset($locales);
    }

    public static function findLocales($route, $glue = '/')
    {
        return array_intersect(app('kyoto')->getLocales(),
            explode($glue, $route));
    }

    public static function extractDomain($route, $locale = null)
    {
        $route = self::replaceDomain($route, $locale);

        preg_match('/^:?https?\:\/\/(.*?)\/(.*?)$/', $route, $match);

        return count($match) === 3 ? $match[1] : $route;
    }

    public static function extractRoute($route, $locale = null)
    {
        $route = self::replaceLocale($route, $locale);

        preg_match('/^:?https?\:\/\/(.*?)\/(.*?)$/', $route, $match);

        return count($match) === 3 ? $match[2] : '/';
    }

    public static function replaceProtocol($route, $protocol = null)
    {
        $route = preg_replace('/^({http}|:http)/', $protocol ?:
            app('kyoto')->getProtocol(), $route);

        return $route;
    }

    public static function replaceDomain($route, $domain = null)
    {
        $route = preg_replace('/({domain}|:domain)/', $domain ?:
            app('kyoto')->getDomain(), $route);

        return $route;
    }

    public static function replaceLocale($route, $locale = null)
    {
        $route = preg_replace('/({locale}|:locale)/', $locale ?:
            app('kyoto')->getLocale(), $route);

        return $route;
    }

    public static function getRoute($route, $locale = true)
    {
        $replace = '/^https?:\/\/[^\/]+/';

        if ( ! $locale ) {
            $replace = '/^https?:\/\/[^\/]+(\/[^\/]{2})?/';
        }

        return preg_replace($replace, '', self::replaceAll($route));
    }

    public static function replaceAll($route, $protocol = null, $domain = null, $locale = null)
    {
        $route = preg_replace_callback('/\{[^\/:]+\}/', function ($match) {

            $final = trim($match[0], '{}');

            if ( $final === 'http' ) {
                return app('kyoto')->getProtocol();
            }

            if ( $final === 'domain' ) {
                return app('kyoto')->getDomain();
            }

            if ( $final === 'locale' ) {
                return app('kyoto')->getLocale();
            }

            return $match[0];
        }, $route);

        $route = preg_replace_callback('/:[^\/:]+/', function ($match) {

            $final = ltrim($match[0], ':');

            if ( $final === 'http' ) {
                return app('kyoto')->getProtocol();
            }

            if ( $final === 'domain' ) {
                return app('kyoto')->getDomain();
            }

            if ( $final === 'locale' ) {
                return app('kyoto')->getLocale();
            }

            return $match[0];
        }, $route);

        return $route;
    }

    public static function prefixLocale($name)
    {
        if ( preg_match('/^[a-z]{2}\./', $name) ) {
            return $name;
        }

        return app('kyoto')->getLocale() . '.' . $name;
    }

    public static function removeLocale($route)
    {
        $route = preg_replace('/^[a-z]{2}\./', '', $route);
        $route = preg_replace('/^[a-z]{2}\//', '', $route);

        return $route;
    }

    public static function getHost()
    {
        return app('kyoto')->getProtocol() . '://' . app('kyoto')->getDomain();
    }

    public static function getPath()
    {
        return '/' . ltrim(request()->path(), '/');
    }

    public static function getUrl()
    {
        return self::getHost() .'/' . ltrim(request()->path(), '/');
    }

    public static function withQuery($url, $query = [])
    {
        if ( empty($query) ) {
            return $url;
        }

        return rtrim($url, '?') . '?' . http_build_query($query);
    }

    public static function isRoute($route, $compare = null)
    {
        if ( ! $compare ) {
            $compare = self::getUrl();
        }

        $lastMatch = substr($route, $position = strrpos($route, '/'));

        if ( strpos($lastMatch, ':') || strpos($lastMatch, '{') ) {
            $lastMatch = substr($route, strrpos($route, '/'), $position * -1);
        }

        if ( strpos($lastMatch, ':') || strpos($lastMatch, '{') ) {
            $lastMatch = substr($route, strrpos($route, '/'), $position * -1);
        }

        if ( $lastMatch && ! strpos($compare, $lastMatch) ) {
            return false;
        }

        $route = preg_quote(self::replaceAll($route), '/');

        $route = preg_replace_callback('/\\\\\/\\\{[^\/]+\\\}/', function ($splits) {
            return preg_match('/\?/', $splits[0]) ? '(.*)?' : '(.*)';
        }, $route);

        $route = preg_replace_callback('/\\\\\/\\\:[^\/]+/', function ($splits) {
            return preg_match('/\?/', $splits[0]) ? '(.*)?' : '(.*)';
        }, $route);


        return !! preg_match('/^' . $route . '\/?$/', $compare);
    }

    public static function isOptionsRoute($options, $compare = null)
    {
        $options += [
            'domain' => self::getHost()
        ];

        $route = app('kyoto')->getProtocol() . '://' .
            str_join('/', $options['domain'], $options['route']);

        return self::isRoute($route, $compare);
    }

    public static function isVue($menuOrRoute)
    {
        if ( Arr::get($menuOrRoute, 'config.vue', false) ) {
            return true;
        }

        return Arr::get($menuOrRoute, 'domain.config.vue', false);
    }

}
