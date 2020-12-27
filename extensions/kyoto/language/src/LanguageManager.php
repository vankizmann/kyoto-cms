<?php

namespace Kyoto\Language;
use Kyoto\Support\Php\PhpEditor;
use Kyoto\Language\Models\Language;
use Kyoto\Language\Models\Translation;

class LanguageManager {

    const LOCALE_PATH = 'kyoto/locale';

    const LANGUAGE_PATH = 'kyoto/language';

    const TRANSLATION_PATH = 'kyoto/translation';

    public $locales = [
        //
    ];

    public $languages = [
        //
    ];

    public $translations = [
        //
    ];

    public function __construct()
    {
        app('kyoto')->fallbackLocalized(function () {
            $this->loadLocales();
        });

        app('kyoto')->setLocales($this->locales);

        $this->loadTranslations();

        foreach ( $this->translations as $locale => $translation) {
            app('translator')->addLines($translation, $locale);
        }

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
        $cachePath = str_replace('/', DIRECTORY_SEPARATOR,
            self::LOCALE_PATH);

        $path = storage_path(str_join('/',
            $cachePath, "locales.php"));

        if ( ! file_exists($path) ) {
            $this->updateLocales();
        }

        $this->locales = PhpEditor::loadFile($path, ['en']);
    }

    public function updateLocales()
    {
        $locales = Language::enabled()->get()->pluck('locale')
            ->toArray();

        $cachePath = str_replace('/', DIRECTORY_SEPARATOR,
            self::LOCALE_PATH);

        $path = storage_path(str_join('/',
            self::LOCALE_PATH, "locales.php"));

        PhpEditor::saveFile($path, $locales);
    }


    public function loadLanguages()
    {
        foreach ( app('kyoto')->getLocales() as $locale ) {

            $path = storage_path(str_join('/',
                self::LANGUAGE_PATH, "{$locale}.php"));

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
                self::LANGUAGE_PATH, "{$locale}.php"));

            PhpEditor::saveFile($path, $languages);
        });
    }

    public function updateLanguages()
    {
        foreach ( app('kyoto')->getLocales() as $locale ) {
            $this->updateLanguage($locale);
        }
    }

    public function loadTranslations()
    {
        foreach ( app('kyoto')->getLocales() as $locale ) {

            $path = storage_path(str_join('/',
                self::TRANSLATION_PATH, "{$locale}.php"));

            if ( ! file_exists($path) ) {
                $this->updateTranslation($locale);
            }

            $this->translations[$locale] = PhpEditor::loadFile($path);
        }
    }

    public function updateTranslation($locale)
    {
        app('kyoto')->localized($locale, function ($locale) {

            $translations = Translation::enabled()->get()
                ->reduce(function ($merge, $translation) {

                    if ( ! strpos($translation->source, '.') ) {
                        $translation->source = "*.{$translation->source}";
                    }

                    return array_merge($merge, [
                        $translation->source => $translation->target
                    ]);

                }, []);

            $path = storage_path(str_join('/',
                self::TRANSLATION_PATH, "{$locale}.php"));

            PhpEditor::saveFile($path, $translations);
        });
    }

    public function updateTranslations()
    {
        foreach ( app('kyoto')->getLocales() as $locale ) {
            $this->updateTranslation($locale);
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
