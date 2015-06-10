<?php

namespace Inz\PerformerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Inz\AppBundle\Entity\InzPerformer;
use Symfony\Component\HttpFoundation\Request;

class PersonalController extends Controller
{
    /**
     * @Route("/performer/personal", name="link_personal")
     * @Template()
     */
    public function indexAction(Request $request)
    {	
		$username = (String) $this->getUser();

		$em = $this->getDoctrine()->getEntityManager();
		$user = $em->getRepository('InzAppBundle:InzUser')->findOneByUsername($username);
		$queryPerformer = $em->getRepository('InzAppBundle:InzPerformer')->findOneById($user);
		
		if($queryPerformer) $performer = $queryPerformer;
		else $performer = new InzPerformer();
		
        $form = $this->createFormBuilder($performer)
            ->add('name', 'text', array('label' => 'Imie: '))
            ->add('surname', 'text', array('label' => 'Nazwisko: '))
            ->add('website', 'text', array('label' => 'Strona internetowa: ', 'required' => false))
            ->add('description', 'textarea', array('label' => 'Opis'))
            ->add('save', 'submit', array('label' => 'Aktualizuj dane'))
            ->getForm();
			
		$form->handleRequest($request);
		if ($form->isValid()) {
			$performer->setId($user);
			$manager = $this->getDoctrine()->getEntityManager();
			$manager->persist($performer);
			$manager->flush();
		}
		
        return array(
            'form' => $form->createView(),
        );
    }
}
