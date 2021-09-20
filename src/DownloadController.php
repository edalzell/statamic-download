<?php

namespace Edalzell\Download;

use Illuminate\Http\Request;
use Statamic\Facades\AssetContainer;
use Statamic\Facades\Path;
use Statamic\Facades\User;
use Statamic\Http\Controllers\Controller;

class DownloadController extends Controller
{
    public function __invoke(Request $request)
    {
        if (! User::current()) {
            return back()->withErrors('Gotta be logged in', 'download');
        }

        /** @var \Statamic\Assets\AssetContainer */
        $container = AssetContainer::find($request->input('container'));

        $path = Path::assemble($container->diskPath(), $request->input('path'));

        if (! file_exists($path)) {
            return back()->withErrors('File not found', 'download');
        }

        return response()->download($path);
    }
}
