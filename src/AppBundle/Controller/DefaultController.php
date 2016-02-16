<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\contactType;

class DefaultController extends Controller
{

    public function indexAction()
    {

        return $this->render('AppBundle:Default:layout/index.html.twig');
    }
    public function initiationAction()
    {

        return $this->render('AppBundle:Default:layout/initiation.html.twig');
    }
    public function locationAction()
    {

        return $this->render('AppBundle:Default:layout/location.html.twig');
    }
    public function randonneesAction()
    {

        return $this->render('AppBundle:Default:layout/randonnees.html.twig');
    }
    public function flyboardAction()
    {

        return $this->render('AppBundle:Default:layout/flyboard.html.twig');
    }
    public function flyfishAction()
    {

        return $this->render('AppBundle:Default:layout/flyfish.html.twig');
    }
    public function partenairesAction()
    {

        return $this->render('AppBundle:Default:layout/partenaires.html.twig');
    }
    public function photosAction()
    {

        return $this->render('AppBundle:Default:layout/galleriePhotos.html.twig');
    }
    public function pageTarifsAction()
    {

        return $this->render('AppBundle:Default:layout/pageTarifs.html.twig');
    }

        public function contactAction(Request $request)
    {

        $form = $this->createForm(contactType::class, new contactType());

        //$request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {

                // Perform some action, such as sending an email
               $objet = $form['objet']->getData();
               $nom = $form['nom']->getData();
                $email = $form['email']->getData();
                $contenu = $form['contenu']->getData();
               $telephone = $form['telephone']->getData();

                // echo $contact['contenu'];
                // envoi du mail qui dit que la commande est bein payé

                $message = \Swift_Message::newInstance()
                    ->setSubject('Nouveau contact sur jetsensation.fr : ' .$objet )
                    ->setFrom(array($email=>$nom))
                    ->setTo($this->container->getParameter('mailer_destinataire'))
                    ->setBcc('david.gerard@ed-creatives.fr')
                    ->setCharset('utf-8')
                    ->setContentType('text/html')
                    ->setBody('Message de '.$nom.'<br>'
                        .$contenu.'<br>Tél: '.$telephone.'<br>e-mail : '.$email);


                //->setBody($this->renderView('GitesBundle:Default:emails/validationCommande.html.twig',array('utilisateur'=>$commande->getUtilisateur())));


                $this->get('mailer')->send($message);


                // fin d mail
                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page

                $this->get('session')->getFlashBag()->add('emailenvoye','<strong>Votre message a bien été envoyé !</strong><br> Nous y répondrons dans les plus brefs délais.<br> Merci pour votre confiance,<br>l\'équipe de jetsensation');
               // return $this->redirect($this->generateUrl('home'));
            }
        }

        return $this->render('AppBundle:Default:layout/contact.html.twig', array(
            'formContact' => $form->createView()
        ));


    }


}
