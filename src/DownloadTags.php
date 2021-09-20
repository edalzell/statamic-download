<?php

namespace Edalzell\Download;

use Statamic\Tags\Tags;

class DownloadTags extends Tags
{
    protected static $handle = 'download';

    public function index()
    {
        return route(
            'statamic.download.show',
            [
                'path' => $this->params->get('file'),
                'container' => $this->params->get('container'),
            ]
        );
    }
}
