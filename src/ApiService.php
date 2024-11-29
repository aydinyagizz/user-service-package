<?php

namespace Services;

abstract class ApiService
{
    protected string $endpoint;
    //protected string $endpoint = 'http://users_backend/api';

    public function request($method, $path, $data = [])
    {
        $response = $this->getRequest($method, $path, $data);

        if ($response->ok()) {
            return $response->json();
        }

        throw new \Exception($response->body());
    }

//    public function request($method, $path, $data = [])
//    {
//        try {
//            // Token'ı request'ten veya cookie'den al
//            $token = request()->bearerToken()
//                ?? request()->cookie('jwt')
//                ?? '';
//
//            // HTTP isteği yap
//            $response = \Http::acceptJson()
//                ->when($token, function($http) use ($token) {
//                    return $http->withToken($token);
//                })
//                ->$method("{$this->endpoint}/{$path}", $data);
//
//            // Başarılı yanıt kontrolü
//            if ($response->successful()) {
//                return $response->json() ?? [];
//            }
//
//            // Detaylı hata mesajı
//            throw new \Exception(
//                "API Request Failed: " .
//                $response->body() .
//                " (Status: " . $response->status() . ")"
//            );
//
//        } catch (\Exception $e) {
//            \Log::error('API Request Error: ' . $e->getMessage());
//            throw $e;
//        }
//    }

    public function getRequest($method, $path, $data = [])
    {
        return \Http::acceptJson()->withHeaders([
            'Authorization' => 'Bearer ' . request()->cookie('jwt')
        ])->$method("{$this->endpoint}/{$path}", $data);
    }

    public function post($path, $data = [])
    {
        // return \Http::post("{$this->endpoint}/{$path}", $data)->json();

       return $this->request('post', $path, $data);
    }

    public function get($path)
    {
//        return \Http::acceptJson()->withHeaders([
//            'Authorization' => 'Bearer ' . request()->cookie('jwt')
//        ])->get("{$this->endpoint}/{$path}")->json();

        return $this->request('get', $path);
    }

    public function put($path, $data)
    {
        return $this->request('put', $path, $data);
    }

    public function delete($path)
    {
        return $this->request('delete', $path);
    }
}
