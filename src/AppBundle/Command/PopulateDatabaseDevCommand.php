<?php

namespace AppBundle\Command;

use AppBundle\Entity\Episode;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class PopulateDatabaseDevCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('PopulateDatabaseDev')
            ->setDescription('Populates the local database with dummy data for testing')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $console = new SymfonyStyle($input, $output);

        $console->text('Filling database with dummy values');

        $this->fillEpisodes();

        $console->success('Database successfully dummified');
    }

    private function fillEpisodes()
    {

        $episodes = array(
            0 => array('1.0','The First','This is Dog'),
            1 => array('1.5','The Weird Middle One','Hi lets have a podcast'),
            2 => array('2.0','The Second','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam in dignissim arcu. Proin dignissim tincidunt'),
            3 => array('3.0','The Third','Etiam sed ullamcorper tellus, nec auctor sem. Nullam ve'),
            4 => array('4.0','The Fourth','Maecenas mollis dignissim nulla, sit amet malesuada mauris.')
        );

        $orm = $this->getContainer()->get('doctrine')->getManager();

        $i=0;

        foreach($episodes as $ep) {
            $episode = new Episode();

            $episode->setNumber($ep[0]);
            $episode->setName($ep[1]);
            $episode->setDescription($ep[2]);
            $episode->setPostDate((new \DateTime('now'))->add(new \DateInterval('P'.$i.'D')));
            $episode->setRecordDate((new \DateTime('now'))->add(new \DateInterval('P'.$i.'D')));

            $orm->persist($episode);

            $i+=7;
        }

        $orm->flush();
    }
}