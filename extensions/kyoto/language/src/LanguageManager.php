<?php

namespace Kyoto\Language;
use Kyoto\Support\Php\PhpEditor;
use Kyoto\Language\Models\Language;
use Kyoto\Language\Models\Translation;

class LanguageManager {

    const LOCALE_PATH = 'kyoto/locale';

    const LANGUAGE_PATH = 'kyoto/language';

    const TRANSLATION_PATH = 'kyoto/translation';

    public $locales = [];

    public $languages = [];

    public $translations = [];

    public function __construct()
    {
        app('kyoto')->fallbackLocalized(function () {
            $this->loadLocales();
        });

        app('kyoto')->setLocales($this->locales);

        $this->loadTranslations();
        $this->patchTranslations();

        $this->loadLanguages();
    }

    public function loadLocales()
    {
        $path = storage_path(str_join('/',
            self::LOCALE_PATH, "locales.php"));

        if ( ! file_exists($path) ) {
            $this->updateLocales();
        }

        $this->locales = PhpEditor::loadFile($path, ['en']);

        return $this;
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

        return $this;
    }

    public function clearLocales()
    {
        $path = storage_path(str_join('/',
            self::LOCALE_PATH, "*.php"));

        foreach ( glob($path) as $file ) {
            unlink($file);
        }

        return $this;
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

        return $this;
    }

    public function updateLanguages()
    {
        foreach ( app('kyoto')->getLocales() as $locale ) {
            $this->updateLanguage($locale);
        }

        return $this;
    }

    public function clearLanguages()
    {
        $path = storage_path(str_join('/',
            self::LANGUAGE_PATH, "*.php"));

        foreach ( glob($path) as $file ) {
            unlink($file);
        }

        app('kyoto.language')->clearLocales();

        return $this;
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

        return $this;
    }

    public function updateTranslation($locale)
    {
        app('kyoto')->localized($locale, function ($locale) {

            $translations = Translation::enabled()->get()
                ->reduce(function ($merge, $translation) {
                    return array_merge($merge, [$translation->source => $translation->target]);
                }, []);

            $path = storage_path(str_join('/',
                self::TRANSLATION_PATH, "{$locale}.php"));

            PhpEditor::saveFile($path, $translations);
        });

        return $this;
    }

    public function updateTranslations()
    {
        foreach ( app('kyoto')->getLocales() as $locale ) {
            $this->updateTranslation($locale);
        }

        return $this;
    }

    public function clearTranslations()
    {
        $path = storage_path(str_join('/',
            self::TRANSLATION_PATH, "*.php"));

        foreach ( glob($path) as $file ) {
            unlink($file);
        }

        return $this;
    }

    public function patchTranslations()
    {
        foreach ( $this->translations as $locale => $translation) {

            $lines = [];

            foreach ( $translation as $source => $target ) {

                if ( empty($translation) ) {
                    dd($this);
                }

                if ( strpos($source, '.') === false || strpos($source, ' ') === false ) {
                    $source = "*.{$source}";
                }

                $lines[$source] = $target;
            }

            app('translator')->addLines($lines, $locale);
        }

        return $this;
    }

    public function getLocales()
    {
        return $this->locales;
    }

    public function getLanguages()
    {
        return $this->languages[app()->getLocale()];
    }

    public function getTranslations()
    {
        return $this->translations[app()->getLocale()];
    }

}
