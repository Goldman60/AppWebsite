<?php
/**
 * Created by PhpStorm.
 * User: aj
 * Date: 10/30/16
 * Time: 12:30 AM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FeedController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function blogAction(Request $request) {
        return new Response("Blog");
    }

    /**
     * @Route("/episodes", name="episodes")
     */
    public function episodesAction(Request $request) {
        //send them to a blog category
        return new Response("Episodes");
    }
}