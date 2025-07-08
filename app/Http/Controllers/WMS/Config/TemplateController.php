<?php

namespace App\Http\Controllers\WMS\Config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class TemplateController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Cache::rememberForever('template_metadata', function () {
                $response = Http::withToken(session('api_token'))->get(config('app.api_service') . '/config/template');
                if ($response->ok()) {
                    return $response->json('metadata');
                }
                return [];
            });
            return view('wms.config.template._data_template', compact('data'));
        }
        return view('wms.config.template.index', [
            'title' => 'Template WhatsApp',
        ]);
    }
}
