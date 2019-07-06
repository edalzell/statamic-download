<?php

namespace Statamic\Addons\Download;

use Statamic\Extend\Tags;

class DownloadTags extends Tags
{
    /**
     * The {{ download }} tag
     *
     * @return string|array
     */
    public function index()
    {
        $q = 'file=' . $this->getParam('file');
        if ($container = $this->getParam('container')) {
            $q .= '&container=' . $container;
        }

        return $this->actionUrl('get?' . $q);
    }

    public function once()
    {
        $q = 'file=' . $this->getParam('file');
        if ($container = $this->getParam('container')) {
            $q .= '&container=' . $container;
        }

        $q .= '&email=' . $this->getParam('email');

        return $this->actionUrl('once?' . $q);
    }

    /**
     * Maps to {{ user_profile:errors }}
     *
     * @return bool|string
     */
    public function errors()
    {
        if (!$this->hasErrors()) {
            return false;
        }

        $errors = [];

        foreach ($this->getErrorBag()->all() as $error) {
            $errors[]['value'] = $error;
        }

        return ($this->content === '') // If this is a single tag...
            ? !empty($errors) // just output a boolean.
            : $this->parseLoop($errors); // Otherwise, parse the content loop.
    }

    /**
     * Does this form have errors?
     *
     * @return bool
     */
    private function hasErrors()
    {
        return (session()->has('errors'))
            ? session('errors')->hasBag('download')
            : false;
    }

    /**
     * Get the errorBag from session
     *
     * @return object
     */
    private function getErrorBag()
    {
        if ($this->hasErrors()) {
            return session('errors')->getBag('download');
        }
    }
}
