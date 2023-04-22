<?php

namespace Zvn\Tools\Trait;

use GuzzleHttp\Client;

Trait SmsTrait{

    /**
     * @return Client
     */
    public function Http(): Client
    {
        return new Client();
    }
}