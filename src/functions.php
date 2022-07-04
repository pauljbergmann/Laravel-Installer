<?php

if (! function_exists('isActive'))
{
    /**
     * Set the active class to the current opened menu.
     *
     * @param  string|array $route
     * @param string $className
     * @return string
     */
    function isActive($route, string $className = 'active'): string
    {
        if (is_array($route)) {
            return in_array(Route::currentRouteName(), $route)
                ? $className
                : '';
        }

        if (Route::currentRouteName() == $route) {
            return $className;
        }

        if (strpos(URL::current(), $route)) {
            return $className;
        }

        return '';
    }
}
