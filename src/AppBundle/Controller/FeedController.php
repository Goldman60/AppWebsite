<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FeedController
{
    /**
     * @Route(
     *      "/feed/podcast/{page}.{_format}",
     *      defaults={"_format": "html"},
     *      name="podcast_feed",
     *      requirements={
     *          "page": "\d+|all"
     *      }
     * )
     * @Route("/episodes", name="episodes_landing")
     */
    public function listEpisodes($page = 1) {
        return new Response("Podcast List Page = " . $page);
    }

    /**
     * @Route(
     *      "/feed/podcast/ep/{episodeNumber}.{_format}",
     *      defaults={"_format": "html"},
     *      name="download_episode",
     *      requirements={
     *          "episodeNumber": "\d+",
     *          "_format": "mp3|wav|html"
     *      }
     * )
     */
    public function downloadEpisode($episodeNumber, $_format) {
        return new Response("Download episode " . $episodeNumber . " in format " . $_format);
    }
}