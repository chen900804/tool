<?php

use PHPUnit\Framework\TestCase;

class ToolsTest extends TestCase
{
    public function testP()
    {
        $a = new Zvn\Tools\Tools();
        self::assertIsString(2,$a->config->get('ZvnTools.appid'));
    }
}