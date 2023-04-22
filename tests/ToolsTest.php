<?php

use PHPUnit\Framework\TestCase;

class ToolsTest extends TestCase
{
    public function testP()
    {
        $a = new Zvn\Tools\Tools();
        self::assertIsString("0",$a->config->has('ZvnTools.appid'));
    }
}