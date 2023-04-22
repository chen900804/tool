<?php

namespace Zvn\Tools;

use Illuminate\Filesystem\Filesystem;
use Zvn\Tools\Exceptions\InvalidToolsException;
use Zvn\Tools\Support\Config;

class Tools
{

    public Config $config;

    /**
     * @throws InvalidToolsException
     */
    public function __construct()
    {
        if (!(new Filesystem())->isFile(dirname(__DIR__) . '/config/ZvnTools.php')) {
            throw new InvalidToolsException('配置文件不存在', 401);
        }
        $this->config = new Config();
        $this->config->loadConfigFiles(__DIR__ . '/../config');
    }


}