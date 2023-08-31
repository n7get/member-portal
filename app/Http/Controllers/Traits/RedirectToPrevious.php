<?php

namespace App\Http\Controllers\Traits;
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
    $previousRouteName = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
    $request->session()->flash('previousRouteName', $previousRouteName);
    $request->session()->flash('previousRouteId', $id);
  }

  /**
   * Redirect to the previous page.
   * param Request $request
   * param string $routeName
   * param int $id
   * return RedirectResponse
   */
  protected function redirectToPrevious(Request $request, string $routeName, int $id = null): RedirectResponse {
    if ($request->session()->has('previousRouteName')) {
        $routeName = $request->session()->get('previousRouteName');
        $id = $request->session()->get('previousRouteId');
    }

    $route = Route::getRoutes()->getByName($routeName);

    if (count($route->parameterNames()) == 0) {
      return redirect()->route($routeName);
    } else {
      return redirect()->route($routeName, $id);
    }
  }
}
