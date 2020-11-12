<?php

if ( ! function_exists('kyoto') ) {

    /**
     * @return \Kyoto\Application\KyotoInstance
     */
    function kyoto ()
    {
        return app('kyoto');
    }

}

if ( ! function_exists('uuid') ) {

    function uuid ()
    {
        return Illuminate\Support\Str::uuid()->toString();
    }

}

if ( ! function_exists('glob_recursive') ) {

    function glob_recursive($pattern, $flags = 0)
    {
        $files = glob($pattern, $flags);

        foreach ( glob(dirname($pattern) . '/*', GLOB_ONLYDIR | GLOB_NOSORT) as $dir ) {
            $files = array_merge($files, glob_recursive($dir . '/' . basename($pattern), $flags));
        }

        return $files;
    }

}

if ( ! function_exists('str_join') ) {

    function str_join($glue, ...$args)
    {
        foreach ( $args as $key => $arg ) {
            $args[$key] = rtrim($arg, $glue);
        }

        return implode($glue, array_filter($args));
    }

}

if ( ! function_exists('array_keys_reduce') ) {

    function array_keys_reduce($input, $function, $inital = null)
    {
       return array_reduce(array_keys($input), $function, $inital);
    }

}
