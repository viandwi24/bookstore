<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Viandwi24\LaravelExtension\Facades\Extension;
use Viandwi24\LaravelExtension\Facades\Hook;
use Illuminate\Support\Collection;

class ExtensionController extends Controller
{
    public function index()
    {
        $extensions = app()->make('extension.booted');
        return view('pages.admin.extension', compact('extensions'));
    }

    public function inspect($name)
    {
        $loaded = app()->make('extension.booted');
        $search = array_search(
            $name,
            (array_column($loaded, 'name'))
        );

        if ($search === false) {
            return abort(404, "Extension {$name} not found.");
        }

        // get action hook
        $actions = [];
        foreach(Hook::getAction() as $action)
        {
            $actions_filter = (new Collection($action))->filter(function ($val) use ($name) {
                return $val->extension === $name;
            });
            $actions_filter->each(function ($val) use (&$actions) {
                $actions[] = $val;
            });
        }

        // get action filter
        $filters = [];
        foreach(Hook::getFilter() as $filter)
        {
            $filters_filter = (new Collection($filter))->filter(function ($val) use ($name) {
                return $val->extension === $name;
            });
            $filters_filter->each(function ($val) use (&$filters) {
                $filters[] = $val;
            });
        }

        $extension = $loaded[$search];
        return view('pages.admin.extension_inspect', compact("extension", "actions", "filters"));
    }

    public function enable($name)
    {
        try {
            Extension::enable($name);
        } catch (\Exception $th) {
            echo $th->getMessage();
            sleep(2);
        }

        return redirect()->back();
    }

    public function disable($name)
    {
        try {
            Extension::disable($name);
        } catch (\Exception $th) {
            echo $th->getMessage();
            sleep(2);
        }
        return redirect()->back();
    }

    public function update()
    {
        try {
            Extension::updateList();
        } catch (\Exception $th) {
            echo $th->getMessage();
            sleep(2);
        }
        return redirect()->back();
    }
}
