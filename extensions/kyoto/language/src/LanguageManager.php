<?php

namespace Kyoto\Language;
use Kyoto\Language\Models\Language;
use Kyoto\Support\Php\PhpEditor;

class LanguageManager {

    const CACHE_PATH = 'kyoto/language';

    public $locales = [
        //
    ];

    public $languages = [
        //
    ];

    public function __construct()
    {
        app('kyoto')->fallbackLocalized(function () {
            $this->loadLocales();
        });

        app('kyoto')->setLocales($this->locales);

        $this->loadLanguages();
    }

    public function update()
    {
        $this->updateLocales();
        $this->loadLocales();
        $this->updateLanguages();
    }

    public function loadLocales()
    {
        $path = storage_path(str_join('/',
            self::CACHE_PATH, "locales.php"));

        if ( ! file_exists($path) ) {
            $this->updateLocales();
        }

        $this->locales = PhpEditor::loadFile($path, ['en']);
    }

    public function updateLocales()
    {
        $locales = Language::enabled()->get()->pluck('locale')
            ->toArray();

        $path = storage_path(str_join('/',
            self::CACHE_PATH, "locales.php"));

        PhpEditor::saveFile($path, $locales);
    }


    public function loadLanguages()
    {
        foreach ( app('kyoto')->getLocales() as $locale ) {

            $path = storage_path(str_join('/',
                self::CACHE_PATH, "{$locale}.php"));

            if ( ! file_exists($path) ) {
                $this->updateLanguage($locale);
            }

            $this->languages[$locale] = PhpEditor::loadFile($path);
        }
    }

    public function updateLanguage($locale)
    {
        app('kyoto')->localized($locale, function ($locale) {

            $languages = Language::enabled()->get()
                ->toArray();

            $path = storage_path(str_join('/',
                self::CACHE_PATH, "{$locale}.php"));

            PhpEditor::saveFile($path, $languages);
        });
    }

    public function updateLanguages()
    {
        foreach ( app('kyoto')->getLocales() as $locale ) {
            $this->updateLanguage($locale);
        }
    }

    public function getLocales()
    {
        return $this->locales;
    }

    public function getLanguages()
    {
        return $this->languages[app()->getLocale()];
    }

}
