<?php

namespace Kyoto\Language\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Kyoto\Language\LanguageManager loadLocales()
 * @method static \Kyoto\Language\LanguageManager updateLocales()
 * @method static \Kyoto\Language\LanguageManager clearLocales()
 * @method static \Kyoto\Language\LanguageManager loadLanguages()
 * @method static \Kyoto\Language\LanguageManager updateLanguages()
 * @method static \Kyoto\Language\LanguageManager clearLanguages()
 * @method static \Kyoto\Language\LanguageManager loadTranslations()
 * @method static \Kyoto\Language\LanguageManager updateTranslations()
 * @method static \Kyoto\Language\LanguageManager clearTranslations()
 * @method static array getLocales()
 * @method static array getLanguages()
 * @method static array getTranslations()
 **/
class KyotoLanguage extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'kyoto.language';
    }
}
