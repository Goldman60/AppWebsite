<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FeedController extends Controller
{
    // feed podcast routes
    // TODO: General XML support for atom feeds

    /**
     * @Route(
     *      "/feed/podcast/{page}.{_format}",
     *      defaults={"_format": "html"},
     *      name="podcast_feed",
     *      requirements={
     *          "page": "\d+|all",
     *          "_format": "html|rss|xml"
     *      }
     * )
     * @Route("/episodes", name="episodes_landing")
     */
    public function listEpisodes($page = 1, $_format) {
        //TODO: Pull episode data

        if($_format == "rss") {
            return $this->render('feed/podcast.rss.twig');
        } else {
            return $this->render('feed/podcast.html.twig');
        }
    }

    /**
     * @Route(
     *      "/feed/podcast/ep/{episodeNumber}.{_format}",
     *      defaults={"_format": "html"},
     *      name="view_episode",
     *      requirements={
     *          "episodeNumber": "\d+",
     *          "_format": "html|rss|xml"
     *      }
     * )
     */
    public function viewEpisode($episodeNumber, $_format) {
        //TODO: Pull episode data

        if($_format == "rss") {
            return $this->render('feed/episode.rss.twig');
        } else {
            return $this->render('feed/episode.html.twig');
        }
    }

    /**
     * @Route(
     *     "/feed/podcast/ep/{episodeNumber}/{episodeName}.{_format}",
     *     name="download_episode",
     *     requirements={
     *          "episodeNumber": "\d+",
     *          "_format": "mp3|ogg"
     *     }
     * )
     */
    public function downloadEpisode($episodeNumber, $_format) {
        //TODO: Counting and analytics, return file here
    }

    // feed route
    /**
     * @Route(
     *      "/feed/{page}.{_format}",
     *      defaults={"_format": "html"},
     *      name="feed_home",
     *      requirements={
     *          "page": "\d+|all",
     *          "_format": "html|rss|xml"
     *      }
     * )
     */
    public function listFeed($page = 1, $_format) {
        //TODO: Pull combined

        if($_format == "rss") {
            return $this->render('feed/feed.rss.twig');
        } else {
            return $this->render('feed/feed.html.twig');
        }
    }
}