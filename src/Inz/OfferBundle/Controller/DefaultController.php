<?php

namespace Inz\OfferBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Inz\AppBundle\Entity\InzAd;
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
        $entity = $em->getRepository('InzAppBundle:InzAd')->find($id);

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
		$offer = new InzAd();
		$username = (String) $this->getUser();

		$em = $this->getDoctrine()->getEntityManager();
		$user = $em->getRepository('InzAppBundle:InzUser')->findOneByUsername($username);
		
        $form = $this->createFormBuilder($offer)
            ->add('title', 'text', array('label' => 'Tytuł ogłoszenia: '))
            ->add('description', 'textarea', array('label' => 'Dokładny opis: '))
            ->add('location', 'textarea', array('label' => 'Zasięg ogłoszenia: ', 'required' => false))
			->add('category', 'entity', array(
				'class' => 'InzAppBundle:InzCategory',
				'property' => 'title',
			))
            ->add('days', 'integer', array('label' => 'Okres aktywności ogłoszenia', 'data' => 14))
            ->add('tags', 'text', array('label' => 'Słowa kluczowe', 'required' => false))
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
	
	/**
     * @Template()
     */
	public function performanceAction($id){
		$username = (String) $this->getUser();
		$em = $this->getDoctrine()->getEntityManager();
        $offer = $em->getRepository('InzAppBundle:InzAd')->find($id);
        $user = $em->getRepository('InzAppBundle:InzUser')->findOneByUsername($username);
		
		if($username){
			if($offer->getAuthor()->getId() == $user->getId())
				return $this->render('InzOfferBundle:Default:addoffer.html.twig');
			else
				return $this->render('InzOfferBundle:Default:lists.html.twig');
		}
				return array();
			
	}
	
	/**
     * @Template()
     */
	public function addofferAction(){
			return array();
	}
	
	/**
     * @Template()
     */
	public function listsAction(){
		$username = (String) $this->getUser();
		$em = $this->getDoctrine()->getEntityManager();
        $offer = $em->getRepository('InzAppBundle:InzAd')->find($id);
        $user = $em->getRepository('InzAppBundle:InzUser')->findOneByUsername($username);
		
		$user = $em->getRepository('InzAppBundle:InzAd')->findOneByUsername($username);
			return array();
	}
}
