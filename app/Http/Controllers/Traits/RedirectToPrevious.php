<?php

namespace App\Http\Controllers\Traits;

use App\Helpers\PreviousRoute;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

trait RedirectToPrevious
{
  /**
   * Save the previous route name in the session.
   * param Request $request
   * param int $id
   */
  protected function savePreviousRoute(Request $request, int $id = null): void
  {
    $currentRoute = Route::currentRouteName();

    $previousRoute = $request->session()->pull('previousRoute');
    if($previousRoute && $previousRoute->getInitialRoute() == $currentRoute) {
        $request->session()->put('previousRoute', $previousRoute);
        return;
    }

    $name = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
    
    $previousRoute = new PreviousRoute($name, $id, $currentRoute);
    
    $request->session()->put('previousRoute', $previousRoute);    
  }

  /**
   * Redirect to the previous page.
   * param Request $request
   * param string $routeName
   * param int $id
   * return RedirectResponse
   */
  protected function redirectToPrevious(Request $request, string $routeName, int $id = null): RedirectResponse {
    $previousRoute = $request->session()->pull('previousRoute');
    if($previousRoute) {
        $routeName = $previousRoute->getName();
        $id = $previousRoute->getId();
    }

    $route = Route::getRoutes()->getByName($routeName);

    if (count($route->parameterNames()) == 0) {
      return redirect()->route($routeName);
    } else {
      return redirect()->route($routeName, $id);
    }
  }
}
