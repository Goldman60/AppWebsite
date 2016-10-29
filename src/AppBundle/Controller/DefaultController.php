<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller {
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        // replace this example code with whatever you need
        return $this->render('primary/index.html.twig', [

        ]);
    }
    /**
     * @Route("/aboutus", name="about")
     */
    public function aboutAction(Request $request) {
        return new Response(
            'This is a test page'
        );
    }
}
