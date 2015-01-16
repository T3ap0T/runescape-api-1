<?php namespace Burthorpe\RunescapeApi\Integrations\Laravel;

use Illuminate\Support\Facades\Facade;

class RunescapeApi extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'runescape_api';
    }

}