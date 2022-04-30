<?php
namespace Zvn\Tool\Tests;

use PHPUnit\Framework\TestCase;
use Zvn\Tool\Tool;

class ToolTest extends TestCase {
    /**
     * 一个单元测试
     */
    public function testTool(){
//        $this->assertTrue(Tool::Statics()->is_mobile('13378190900'),'错误');
        $a = Tool::HttpTool()->getIpWeather('182.134.13.198');
        $this->assertTrue($a['stats'],json_encode($a));
    }
}