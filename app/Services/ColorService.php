<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ColorService
{
    private $base;
    public function __construct()
    {
        $this->base = 'https://www.thecolorapi.com';
    }

    public function get_name($hexs)
    {
        $arr = [];
        for ($i = 0; $i < count($hexs); $i = $i + 3) {
            $response = Http::baseUrl($this->base)->get("/id?hex=" . trim($hexs[$i], "#"));
            $arr[] = $response->json()['name']['value'];
        }
        return $arr;
    }
}
