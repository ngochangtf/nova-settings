<?php

namespace Outl1ne\NovaSettings\Traits;

use Closure;
use Illuminate\Http\Request;
use Outl1ne\NovaSettings\NovaSettings;

trait WithEvents
{
    protected function processWithEvents(Request $request, Closure $callback): mixed
    {
        if (is_callable(NovaSettings::$beforeUpdating)) {
            call_user_func(NovaSettings::$beforeUpdating, $request);
        }

        $result = $callback($request);

        if (is_callable(NovaSettings::$afterUpdated)) {
            call_user_func_array(NovaSettings::$afterUpdated, [$request, &$result]);
        }

        return $result;
    }
}