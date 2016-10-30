<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class MainController extends Controller {
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        return $this->render('primary/index.html.twig', [

        ]);
    }

    /**
     * @Route("/hosts", name="hosts")
     */
    public function hostsAction(Request $request) {
        return $this->render('primary/hosts.html.twig', [

        ]);
    }

    /**
     * @Route("/subscribe", name="subscribe")
     */
    public function subscribeAction(Request $request) {
        return $this->render('primary/subscribe.html.twig', [

        ]);
    }
}
