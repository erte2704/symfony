<?php

namespace My\HelloworldBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use My\HelloworldBundle\Entity\imiona;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
	
	
	/**
     * @Route("/addNew")
     * @Template()
     */
	 
    public function addAction()
    {
		
		$imiona = new imiona();
		$imiona->setName('Ania');
		
		$manager = $this->getDoctrine()->getEntityManager();
		$manager->persist($imiona);
		$manager->flush();
		
        return array();
    }
	
}
