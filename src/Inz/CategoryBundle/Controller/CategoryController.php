<?php

namespace Inz\CategoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CategoryController extends Controller
{
    /**
     * @Route("/category/{alias}", name="link_category")
     * @Template()
     */
    public function categoryAction($alias)
    {
		$em = $this->getDoctrine()->getEntityManager();
		$category = $em->getRepository('InzAppBundle:InzCategory')->findOneByAlias($alias);
		
		$entities = $em->getRepository('InzAppBundle:InzAd')->findByCategory($category);
		
        return compact('category','entities');
    }
}
