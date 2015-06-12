<?php

namespace Inz\AdBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Inz\AppBundle\Entity\InzAd;
use Inz\AppBundle\Entity\InzUser;
use Inz\AppBundle\Entity\InzOffer;
use Symfony\Component\HttpFoundation\Request;

/**
* @Route("/ad")
*/
class DefaultController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
	
	/**
     * @Route("/id/{id}", name="link_ad")
     * @Method("GET")
     * @Template()
     */
    public function adAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('InzAppBundle:InzAd')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Wyszukiwana oferta nie istnieje');
        }

        return compact('entity');
    }
	
	/**
     * @Route("/add/", name="link_ad_add")
     * @Template()
     */
    public function addAction(Request $request)
    {
		$ad = new InzAd();
		$username = (String) $this->getUser();

		$em = $this->getDoctrine()->getEntityManager();
		$user = $em->getRepository('InzAppBundle:InzUser')->findOneByUsername($username);
		
        $form = $this->createFormBuilder($ad)
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
			$ad->setAuthor($user);
			$ad->setDate(new \DateTime('today'));
			$ad->setVisit(1);
			$manager = $this->getDoctrine()->getEntityManager();
			$manager->persist($ad);
			$manager->flush();
	
		}
		
        return array(
            'form' => $form->createView(),
        );
    }
	
	/**
     * @Method("GET")
     * @Template()
     */
	public function offerAction($id){
		$username = (String) $this->getUser();
		$em = $this->getDoctrine()->getEntityManager();
        $ad = $em->getRepository('InzAppBundle:InzAd')->find($id);
        $user = $em->getRepository('InzAppBundle:InzUser')->findOneByUsername($username);
        $performer = $em->getRepository('InzAppBundle:InzPerformer')->findById($user);
		$offers = $em->getRepository('InzAppBundle:InzOffer')->findByAd($ad);
		
		if($username){
			if($ad->getAuthor()->getId() === $user->getId() && !$offers)
				return $this->render('InzAdBundle:Default:emptylist.html.twig');
			elseif($ad->getAuthor()->getId() === $user->getId()){
				return $this->render('InzAdBundle:Default:list.html.twig', array('id' => $id, 'offers' => $offers));
			}elseif($username && $ad->getAuthor()->getId() != $user->getId() && !$performer)
				return $this->render('InzAdBundle:Default:addperformer.html.twig');
			else
				return $this->render('InzAdBundle:Default:addoffer.html.twig', array('id' => $id, 'form' => $this->generateOfferForm($id, $user->getId())));
		}
				return array();
			
	}
	
	/**
     * @Method("GET")
     * @Template()
     */
	public function addofferAction($id, $form){
		
	}
	
	
	/**
     * @Route("/id/{id}")
     * @Method("POST")
     * @Template()
     */
	public function saveOfferAction(Request $request){
		$data = $request->request->all();
		
		$em = $this->getDoctrine()->getEntityManager();
        $ad = $em->getRepository('InzAppBundle:InzAd')->find($data['form']['ad']);
        $performer = $em->getRepository('InzAppBundle:InzPerformer')->find($data['form']['performer']);
		
		$offer = new InzOffer();
		$offer->setPrice($data['form']['price']);
		$offer->setLocation($data['form']['location']);
		$offer->setAccept(0);
		$offer->setCompleted(0);
		$offer->setAd($ad);
		$offer->setPerformer($performer);
		$manager = $this->getDoctrine()->getEntityManager();
		$manager->persist($offer);
		$manager->flush();
		
		return $this->redirectToRoute('link_ad', array('id' => $data['form']['ad']));
	}
	
	
	/**
     * @Template()
     */
	public function listAction($id, $offers){
	}
	
	/**
     * @Template()
     */
	public function emptylistAction(){
		return array();
	}
	
	/**
     * @Template()
     */
	public function addperformerAction(){
		return array();
	}
	
	private function generateOfferForm($add, $performer){
		$offer = new InzOffer();
		$em = $this->getDoctrine()->getEntityManager();
        $ad = $em->getRepository('InzAppBundle:InzOffer')->findOneBy(array('ad' => $add, 'performer' => $performer));
		
		if(!$ad){
			$form = $this->createFormBuilder($offer)
				->add('price', 'integer', array('label' => 'Proponowana cena: '))
				->add('description', 'textarea', array('label' => 'Opis realizacji: '))
				->add('location', 'text', array('label' => 'Miejsce wykonania: '))
				->add('ad', 'hidden', array('data' => $add))
				->add('performer', 'hidden', array('data' => $performer))
				->add('save', 'submit', array('label' => 'Dodaj oferte'))
				->getForm();
			
			return $form->createView();
		}
		
		return $ad;
	}
}
