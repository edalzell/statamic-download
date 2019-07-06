<?php

namespace Statamic\Addons\Download;

use Statamic\API\Path;
use Statamic\API\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Statamic\Extend\Controller;
use Statamic\API\AssetContainer;

class DownloadController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function getGet(Request $request)
    {
        if (!User::getCurrent()) {
            return back()->withErrors('Gotta be logged in', 'download');
        }

        if (!file_exists($path = $this->getPath($request))) {
            return back()->withErrors('File not found', 'download');
        }

        return response()->download($path);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function getOnce(Request $request)
    {
        $email = $request->input('email');

        if (!file_exists($path = $this->getPath($request))) {
            return back()->withErrors('File not found', 'download');
        }

        // check if this email address has downloaded this already
        if ($this->alreadyDownloaded($email, $path)) {
            return back()->withErrors('Already downloaded', 'download');
        }

        $this->addFile($email, $path);

        return response()->download($path);
    }

    private function alreadyDownloaded($email, $path)
    {
        return in_array($path, $this->storage->getYAML($email, []));
    }

    private function addFile($email, $path)
    {
        $files = $this->storage->getYAML($email, []);

        $files[] = $path;

        $this->storage->putYAML($email, $files);
    }

    private function getPath($request)
    {
        $container = AssetContainer::find(
            $request->input(
                'container',
                $this->getConfig('container')
            )
        );

        return Path::assemble($container->resolvedPath(), $request->input('file'));
    }
}
