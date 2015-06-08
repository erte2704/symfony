<?php

namespace My\HelloworldBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
class PodstronaController extends Controller
{
	/**
     * @Route("/podstrona", name="link_podstrona")
     * @Template()
     */
    public function podstronanowaAction()
    {
		$em = $this->getDoctrine()->getEntityManager();
		$entities = $em->getRepository('MyHelloworldBundle:imiona')->findAll();
		
        return compact('entities');
    }
}
