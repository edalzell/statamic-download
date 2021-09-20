<?php

namespace Edalzell\Download;

use Statamic\Tags\Tags;

class DownloadTags extends Tags
{
    protected static $handle = 'download';

    public function index()
    {
        /** @var \Statamic\Assets\Asset */
        $asset = $this->params->get('file');

        return route(
            'statamic.download.show',
            [
                'path' => $asset->path(),
                'container' => $this->params->get('container'),
            ]
        );
    }
}
