<?php

namespace Services;

class UserService extends ApiService
{
    public function __construct()
    {
       // $this->endpoint = 'http://host.docker.internal:8001/api';
       // $this->endpoint = 'http://users_ms:8000/api';
        $this->endpoint = env('USERS_MS') . '/api';
    }
}
