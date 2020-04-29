<?php

namespace Statamic\Addons\Download\SuggestModes;

use Statamic\API\AssetContainer;
use Statamic\Addons\Suggest\Modes\AbstractMode;

class AssetContainersSuggestMode extends AbstractMode
{
    public function suggestions()
    {
        return AssetContainer::all()
            ->filter(function ($container) {
                return !$container->accessible();
            })->map(function ($container, $key) {
                return ['value' => $key, 'text' => $container->title()];
            })->values()->all();
    }
}
