<?php

namespace My\HelloworldBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use My\HelloworldBundle\Entity\imiona;
use My\HelloworldBundle\Form\imionaType;

/**
 * imiona controller.
 *
 * @Route("/imiona")
 */
class imionaController extends Controller
{

    /**
     * Lists all imiona entities.
     *
     * @Route("/", name="imiona")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MyHelloworldBundle:imiona')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new imiona entity.
     *
     * @Route("/", name="imiona_create")
     * @Method("POST")
     * @Template("MyHelloworldBundle:imiona:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new imiona();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('imiona_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a imiona entity.
     *
     * @param imiona $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(imiona $entity)
    {
        $form = $this->createForm(new imionaType(), $entity, array(
            'action' => $this->generateUrl('imiona_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new imiona entity.
     *
     * @Route("/new", name="imiona_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new imiona();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a imiona entity.
     *
     * @Route("/{id}", name="imiona_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyHelloworldBundle:imiona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find imiona entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing imiona entity.
     *
     * @Route("/{id}/edit", name="imiona_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyHelloworldBundle:imiona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find imiona entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a imiona entity.
    *
    * @param imiona $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(imiona $entity)
    {
        $form = $this->createForm(new imionaType(), $entity, array(
            'action' => $this->generateUrl('imiona_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing imiona entity.
     *
     * @Route("/{id}", name="imiona_update")
     * @Method("PUT")
     * @Template("MyHelloworldBundle:imiona:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyHelloworldBundle:imiona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find imiona entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('imiona_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a imiona entity.
     *
     * @Route("/{id}", name="imiona_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MyHelloworldBundle:imiona')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find imiona entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('imiona'));
    }

    /**
     * Creates a form to delete a imiona entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('imiona_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
