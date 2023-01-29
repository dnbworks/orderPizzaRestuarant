<?php

namespace tests\unit;

use app\core\Application;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase 
{
    /** @test */
    public function it_login() : void
    {
        $config = [
            'userClass' => \app\models\UserModel::class,
            'db' => []
        ];

        $app = new Application(ROOT_PATH, $config);
        $expected = ROOT_PATH;
        $this->assertEquals(Application::$ROOT_DIR, $expected);
    }
}