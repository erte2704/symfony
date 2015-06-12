<?php

namespace Inz\AdBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Inz\AppBundle\Entity\InzAd;
use Inz\AppBundle\Entity\InzUser;
use Inz\AppBundle\Entity\InzPerformer;
use Inz\AppBundle\Entity\InzOffer;
use Symfony\Component\HttpFoundation\Request;

/**
* @Route("/ad/my")
*/
class MyController extends Controller
{
	/**
     * @Route("/ad", name="link_my_ad")
     * @Method("GET")
     * @Template()
     */
    public function adAction()
    {
		$username = (String) $this->getUser();
        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository('InzAppBundle:InzUser')->findByUsername($username);
        $entities = $em->getRepository('InzAppBundle:InzAd')->findByAuthor($user);
		
		if($entities) return compact('entities');
		else return array('entities' => false);
    }
	
	
	/**
     * @Route("/offer", name="link_my_offer")
     * @Method("GET")
     * @Template()
     */
    public function offerAction()
    {
		$username = (String) $this->getUser();
        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository('InzAppBundle:InzUser')->findOneByUsername($username);
        $performer = $em->getRepository('InzAppBundle:InzPerformer')->find($user);
        $entities = $em->getRepository('InzAppBundle:InzOffer')->findByPerformer($performer);

		if($entities) return compact('entities');
		else return array('entities' => false);
    }
	
}
