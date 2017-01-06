<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('index/login.html.twig');
    }
	
	/**
     * @Route("/activate", name="activate")
     */
	public function activate(Request $request)
	{
        //load company
        $companyService = $this->get('service.company');
        $company = $companyService->getCompany();

        if (!$company)
        {
            return $this->render('index/activate.html.twig', ['activateStatus' => false, 'error' => 'wrong_account']);
        }

        if ($request->getMethod() == 'GET')
        {
            $activateCode = $request->query->get('code');

            if ($company->getActivateCode() == '0')
            {
                return $this->render('index/activate.html.twig', ['activateStatus' => false, 'error' => 'already_activated']);
            }
            else
            {
                if ($company->getActivateCode() != $activateCode)
                {
                    return $this->render('index/activate.html.twig', ['activateStatus' => false, 'error' => 'link_expired']);
                }
                else
                {
                    //activate company
                    $em = $this->getDoctrine()->getManager();
                    $company->setActive('Y')->setActivateCode('');
                    $em->persist($company);
                    $em->flush();

                    //get admin user
                    $user = $this->getDoctrine()
                        ->getRepository('AppBundle:Users')
                        ->findOneBy(['admin' => 'Y', 'company_id' => $company->getId()]);

                    if ($user)
                    {
                        //send mail
                        $message = \Swift_Message::newInstance()
                            ->setSubject('Welcome to inWorkFlow')
                            ->setFrom(['info@inworkflow.pp.ua' => 'inWorkFlow'])
                            ->setTo([$user->getEmail() => $user->getName()])
                            ->setBody(
                                $this->renderView('email/activate.html.twig',
                                    ['user' => $user, 'company' => $company, 'host' => $_SERVER['HTTP_HOST']]
                                ),
                                'text/html'
                            );

                        $this->get('mailer')->send($message);
                    }

                    //render
                    return $this->render('index/activate.html.twig', ['activateStatus' => true]);
                }
            }
        }
	}
}
