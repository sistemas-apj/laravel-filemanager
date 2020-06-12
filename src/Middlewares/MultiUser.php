<?php

namespace UniSharp\LaravelFilemanager\Middlewares;

use Closure;
<<<<<<< HEAD:src/Middlewares/MultiUser.php
use UniSharp\LaravelFilemanager\Lfm;
=======
use UniSharp\LaravelFilemanager\Traits\LfmHelpers;
>>>>>>> v3.4:src/middlewares/MultiUser.php

class MultiUser
{
    private $helper;

    public function __construct()
    {
        $this->helper = app(Lfm::class);
    }

    public function handle($request, Closure $next)
    {
        if ($this->helper->allowFolderType('user')) {
            $previous_dir = $request->input('working_dir');
            $working_dir = $this->helper->getRootFolder('user');

            if ($previous_dir == null) {
                $request->merge(compact('working_dir'));
            } elseif (! $this->validDir($previous_dir)) {
                $request->replace(compact('working_dir'));
            }
        }

        return $next($request);
    }

    private function validDir($previous_dir)
    {
        if (starts_with($previous_dir, $this->helper->getRootFolder('share'))) {
            return true;
        }

        if (starts_with($previous_dir, $this->helper->getRootFolder('user'))) {
            return true;
        }

        return false;
    }
}
