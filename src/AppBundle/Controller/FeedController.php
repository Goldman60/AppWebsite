<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
    public function listEpisodes($page = 1, String $_format) {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Episode');

        if($page == 'all') {
            $episodes = $repo->allEpisodes();
            $pages = null;
        } else {
            $episodes = $repo->getEpisodesByPage($page, 25); //TODO: hardcode
            //TODO: calculate pagination
        }

        if(!$episodes) { //no episodes for this page
            throw $this->createNotFoundException();
        }

        if($_format == "rss") {
            return $this->render('feed/podcast.rss.twig', array(
                'eps' => $episodes
            ));
        } else {
            return $this->render('feed/podcast.html.twig', array(
                'eps' => $episodes
            ));
        }
    }

    /**
     * @Route(
     *      "/feed/podcast/ep/{epNum}.{_format}",
     *      defaults={
     *          "_format": "html"
     *      },
     *      name="view_episode",
     *      requirements={
     *          "epNum": "\d+.\d+|\d+",
     *          "_format": "html|rss|xml"
     *      }
     * )
     * @param String $epNum string that takes the form of # or #.#
     * @param String $_format html/rss/xml (atom)
     * @return Response
     */
    public function viewEpisode(String $epNum, String $_format) {

        $ep = $this->getDoctrine()->getRepository('AppBundle:Episode')
            ->findEpisodeByNumber($epNum);

        if(!$ep) {
            throw $this->createNotFoundException(
                'episode ' . $epNum . ' was not found!'
                //TODO: better page than this
            );
        }

        if($_format == "rss") {
            return $this->render('feed/episode.rss.twig', array(
                'episode' => $ep
            ));
        } else {
            return $this->render('feed/episode.html.twig', array(
                'episode' => $ep
            ));
        }
    }

    /**
     * @Route(
     *     "/feed/podcast/ep/{episodeNumber}/{episodeName}.{_format}",
     *     name="download_episode",
     *     requirements={
     *          "episodeNumber": "\d+.\d+|\d+",
     *          "_format": "mp3|ogg"
     *     }
     * )
     */
    public function downloadEpisode($episodeNumber, $_format) {
        //TODO: Counting and analytics, return file here
        throw $this->createAccessDeniedException('Not implemented');
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