<?php

namespace AppBundle\Command;

/**
 * Custom automated installation of assets this site uses
 */

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;

class InstallCustomAssetsCommand extends ContainerAwareCommand
{
    const WEB_TARGET = 'web/bundles/';

    /**
     * @var Filesystem
     */
    private $fs;
    /**
     * @var String
     */
    private $rootDir;

    protected function configure()
    {
        $this
            ->setName('InstallCustomAssets')
            ->setDescription('Installs the custom bootstrap, jquery, and tether assets that assets:install misses')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->fs = $this->getContainer()->get('filesystem');
        $this->rootDir = realpath($this->getContainer()->getParameter('kernel.root_dir') . '/..');
        $console = new SymfonyStyle($input, $output);

        //Process bootstrap
        $this->processBundleAssets('twbs', 'bootstrap', '/dist');

        //Process jQuery
        $this->processBundleAssets('components', 'jquery', '');

        //Process Tether
        $this->processBundleAssets('bordercloud', 'tether', '/dist');


        $console->newLine();
        $console->success('Custom assets successfully installed');
    }

    private function processBundleAssets(String $vendorDir, String $packageName, String $customAssetDir = '') {
        $sourceDir = $this->rootDir . '/vendor/' . $vendorDir . '/' . $packageName . $customAssetDir;
        $targetDir = $this->rootDir . '/' . self::WEB_TARGET . $packageName;

        $this->fs->symlink($sourceDir,$targetDir,true);
    }

}
