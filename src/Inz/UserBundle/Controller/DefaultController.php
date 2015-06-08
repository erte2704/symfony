<?php

namespace Inz\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Inz\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/newuser")
     * @Template()
     */
    public function indexAction(Request $request)
    {	
		$User = new User();

        $form = $this->createFormBuilder($User)
            ->add('name', 'text')
            ->add('passwd', 'repeated', array(
				'type' => 'password',
				'invalid_message' => 'Hasła muszą być identyczne.',
				'required' => true,
				'first_options'  => array('label' => 'Hasło:'),
				'second_options' => array('label' => 'Powtórz hasło:'),
			))
            ->add('email', 'text')
            ->add('authentication', 'text')
            ->add('save', 'submit', array('label' => 'Create Task'))
            ->getForm();
		
		$form->handleRequest($request);
		
		if ($form->isValid()) {
			$manager = $this->getDoctrine()->getEntityManager();
			$manager->persist($User);
			$manager->flush();
			return $this->redirectToRoute('link_front');
		}
        
		return array('form' => $form->createView());
    }
	
}
