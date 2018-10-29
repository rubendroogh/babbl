<?php
namespace App\Babbl;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

class BotUtil
{
    public function __construct()
    {
        DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);
        $config = [];
        $this->botman = BotManFactory::create($config);
    }

    public function get_bot_message(){
        $this->botman->hears('.*LOL.*', function (BotMan $bot) {
            $bot->reply('banaan');
        });

        $this->botman->listen();
    }
}