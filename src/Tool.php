<?php

namespace Zvn\Tool;

use Zvn\Tool\HttpTool\HttpTool;
use Zvn\Tool\Statics\Statics;

class Tool {



    /**
     * @return HttpTool
     */
    public static function HttpTool(): HttpTool
    {
        return new HttpTool();
    }


    /**
     * @return Statics
     */
    public static function Statics(): Statics
    {
        return new Statics();
    }
}