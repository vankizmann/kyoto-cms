<?php

namespace Kyoto\Application\Plugins;

trait LanguagePlugin
{
    /**
     * Fallback locale.
     *
     * @var string
     */
    public $fallbackLocale = 'en';

    /**
     * Locale store.
     *
     * @var string
     */
    public $locale = 'en';

    /**
     * Locales store.
     *
     * @var array
     */
    public $locales = ['en', 'de', 'da'];

    /**
     * Register language plugin
     *
     * @return void
     */
    public function registerLanguagePlugin()
    {
        $this->locale = config('app.locale');
        $this->fallbackLocale = config('app.fallback_locale');
    }

    /**
     * Boot language plugin
     *
     * @return void
     */
    public function bootLanguagePlugin()
    {
        if ( app('cache')->has('kyoto.locales') ) {
            $this->locales = app('cache')->get('kyoto.locales');
        }

        // Set base language
        $this->locale = reset($this->locales);

        // Get http language
        $http = @$_SERVER['HTTP_ACCEPT_LANGUAGE'] ?: '';

        preg_match_all('/((?<=,)[a-z]{2}(?=;)|^[a-z]{2}(?=-|,))/',
            $http, $accepted, PREG_PATTERN_ORDER);

        $accepted = array_filter(reset($accepted));

        if ( $locale = collect($this->locales)->intersect($accepted)->last() ) {
            $this->locale = $locale;
        }

        $segments = request()->segments();

        if ( $locale = collect($this->locales)->intersect($segments)->first() ) {
            $this->locale = $locale;
        }

        app()->setLocale($this->locale);
    }

    /**
     * Set fallback locale
     *
     * @param $locale
     * @return void
     */
    public function setFallbackLocale($locale)
    {
        $this->fallbackLocale = $locale;
    }

    /**
     * Get fallback locale
     *
     * @return string
     */
    public function getFallbackLocale()
    {
        return $this->fallbackLocale;
    }

    /**
     * Is fallback locale
     *
     * @param null $locale
     * @return string
     */
    public function isFallbackLocale($locale = null)
    {
        return $this->fallbackLocale === $locale ?: $this->locale;
    }

    /**
     * Get current locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set current locale
     *
     * @param $locale
     */
    public function setLocale($locale)
    {
        app()->setLocale($this->locale = $locale);
    }

    /**
     * Get allowed locales
     *
     * @return array
     */
    public function getLocales()
    {
        return $this->locales;
    }

    /**
     * Set allowed locales
     *
     * @param $locales
     */
    public function setLocales($locales)
    {
        $this->locales = $locales;
    }

    /**
     * Run script inside diffrent locale
     *
     * @param $locale
     * @param $callback
     * @return mixed
     */
    public function localized($locale, $callback)
    {
        $initialLocal = $this->locale;

        $this->setLocale($locale);
        $result = $callback($locale);
        $this->setLocale($initialLocal);

        return $result;
    }

}
