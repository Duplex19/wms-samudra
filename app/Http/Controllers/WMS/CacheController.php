<?php

namespace App\Http\Controllers\WMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class CacheController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->only('key'), 
        [
            'key' => 'required|string' 
        ],
        [
            'key.required' => 'Key wajib diisi!'
        ]);

        if($validator->fails()) {
            return $this->error('Error', 'Key wajib diisi', 422);
        }

        Cache::forget($request->key);
        return $this->success(null, 'Cache ' . $request->key . ' berhasil dihapus!');
    }
}
