<?php

namespace Ob\PairfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MainController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $entityManager = $this->get('doctrine')->getManager();
        $users = $entityManager->getRepository('Ob\PairfonyBundle\Entity\User')->findAll();

        return array(
            'users' => $users
        );
    }
}
