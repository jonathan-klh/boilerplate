<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Service\FormService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, FormService $FormService)
    {

        $entity = new Contact();

        $form = $this->createForm(ContactType::class, $entity, [
            'allow_extra_fields' => true
        ]);

        if ($request->getMethod() === "POST"){

            $entity = $FormService->dataBuild($entity);
            $form->setData($entity);

            $form->handleRequest($request);

            if($form->isValid() && $form->isSubmitted()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
                $this->addFlash("success", "Your request have been succeed : ". $entity->getSujet());
                return $this->redirect('contact');
            }
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/contact/form/loading", name="contact_form_is_loading")
     */
    public function formIsLoading(Request $request)
    {
        $options = [
            'action' => $action = $this->generateUrl('contact'),
            'method' => "POST",
        ];

        $contact = new Contact();
        $contact->setSujet($request->get('value'));

        $form = $this->createForm(ContactType::class, $contact , $options);

        $view = $this->renderView('contact/new.html.twig', [
            'form' => $form->createView()
        ]);

        return new JsonResponse(['view' => $view], 200);
    }
}
