<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GatewayController extends Controller
{
    public function getPosts(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => $request->header('Authorization'),
            'Accept'        => 'application/json',
        ])->get(env('BLOG_SERVICE_URL') . '/api/posts');

        return response()->json($response->json(), $response->status());
    }

    public function createPost(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => $request->header('Authorization'),
            'Accept'        => 'application/json',
        ])->post(env('BLOG_SERVICE_URL') . '/api/posts', $request->all());

        return response()->json($response->json(), $response->status());
    }

    public function createUser(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => $request->header('Authorization'),
            'Accept'        => 'application/json',
        ])->post(env('USER_SERVICE_URL') . '/api/create', $request->all());

        return response()->json($response->json(), $response->status());
    }

    public function getUsers(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => $request->header('Authorization'),
            'Accept'        => 'application/json',
        ])->get(env('USER_SERVICE_URL') . '/api/getusers');

        return response()->json($response->json(), $response->status());
    }

}
