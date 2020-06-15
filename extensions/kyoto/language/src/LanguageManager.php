<?php

namespace Kyoto\Language;
use Kyoto\Language\Models\Language;
use Kyoto\Support\Php\PhpEditor;

class LanguageManager {

    const CACHE_PATH = 'kyoto/language';

    public $languages = [
        //
    ];

    public function __construct()
    {
        app('kyoto')->fallbackLocalized(function () {
            $this->load();
        });
    }

    public function load()
    {
        $path = storage_path(str_join('/',
            self::CACHE_PATH, "languages.php"));

        if ( ! file_exists($path) ) {
            $this->updateLocales();
        }

        $this->languages = PhpEditor::loadFile($path, ['en']);
    }

    public function updateLocales()
    {
        $menus = Language::enabled()->get()
            ->toArray();

        $path = storage_path(str_join('/',
            self::CACHE_PATH, "languages.php"));

        PhpEditor::saveFile($path, $menus);
    }

    public function getLocales()
    {
        $locales = [];

        foreach ( $this->languages as $language ) {
            $locales[] = $language['locale'];
        }

        return $locales;
    }

}
