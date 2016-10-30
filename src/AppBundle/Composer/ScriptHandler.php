<?php

namespace AppBundle\Composer;

use Composer\Script\Event;

class ScriptHandler extends \Sensio\Bundle\DistributionBundle\Composer\ScriptHandler {


    /**
     * Call the custom asset installer
     *
     * @param $event CommandEvent A instance
     */
    public static function installCustomAssets(Event $event)
    {
        $options = self::getOptions($event);
        $consoleDir = self::getConsoleDir($event, 'hello world');

        if (null === $consoleDir) {
            return;
        }

        static::executeCommand($event, $consoleDir, 'InstallCustomAssets', $options['process-timeout']);
    }

}