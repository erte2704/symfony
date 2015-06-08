<?php

namespace Inz\OfferBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Inz\AppBundle\Entity\InzOffer;
use Inz\AppBundle\Entity\InzUser;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/offer")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
	
	/**
     * @Route("/offer/id/{id}", name="link_offer")
     * @Method("GET")
     * @Template()
     */
    public function offerAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('InzAppBundle:InzOffer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Wyszukiwana oferta nie istnieje');
        }

        return compact('entity');
    }
	
	/**
     * @Route("/offer/add/", name="link_add_offer")
     * @Template()
     */
    public function addAction(Request $request)
    {
		$offer = new InzOffer();
		$username = (String) $this->getUser();

		$em = $this->getDoctrine()->getEntityManager();
		$user = $em->getRepository('InzAppBundle:InzUser')->findOneByUsername($username);
		
        $form = $this->createFormBuilder($offer)
            ->add('title', 'text', array('label' => 'Tytuł ogłoszenia: '))
            ->add('description', 'textarea', array('label' => 'Dokładny opis: '))
            ->add('location', 'textarea', array('label' => 'Zasięg ogłoszenia: '))
			->add('category', 'entity', array(
				'class' => 'InzAppBundle:InzCategory',
				'property' => 'title',
			))
            ->add('days', 'integer', array('label' => 'Okres aktywności ogłoszenia', 'data' => 14))
            ->add('tags', 'text', array('label' => 'Słowa kluczowe'))
            ->add('save', 'submit', array('label' => 'Dodaj ogłoszenie'))
            ->getForm();
			
		$form->handleRequest($request);
		if ($form->isValid()) {
			$offer->setAuthor($user);
			$offer->setDate(new \DateTime('today'));
			$offer->setVisit(1);
			$manager = $this->getDoctrine()->getEntityManager();
			$manager->persist($offer);
			$manager->flush();
	
		}
		
        return array(
            'form' => $form->createView(),
        );
    }
}
