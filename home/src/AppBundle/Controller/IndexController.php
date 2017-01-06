<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Company;
use AppBundle\Entity\Users;
use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        //get countries
        $countries = $this->getDoctrine()->getRepository('AppBundle:Country')->findBy([], ['country_name' => 'ASC']);
        return $this->render('pages/home.html.twig', ['countries' => $countries]);
    }

    /**
     * @Route("/signup", name="signup")
     */
    public function signupAction(Request $request)
    {
        if ($request->getMethod() == 'POST')
        {
            $account    = $request->request->get('company');
            $user       = $request->request->get('user');

            if ($account['name'] == '')     return $this->_result(['code' => '-1', 'mess' => 'empty_fields']);
            if ($account['company'] == '')  return $this->_result(['code' => '-1', 'mess' => 'empty_fields']);
            if ($account['site'] == '')     return $this->_result(['code' => '-1', 'mess' => 'empty_fields']);
            if ($account['country'] == '')  return $this->_result(['code' => '-1', 'mess' => 'empty_fields']);

            if ($user['name'] == '')        return $this->_result(['code' => '-1', 'mess' => 'empty_fields']);
            if ($user['email'] == '')       return $this->_result(['code' => '-1', 'mess' => 'empty_fields']);
            if ($user['passwd'] == '')      return $this->_result(['code' => '-1', 'mess' => 'empty_fields']);

            //check user email
            if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL))
                return $this->_result(['code' => '-1', 'mess' => 'wrong_email']);

            //parse website
            if( strpos($account['site'], "http://") === false && strpos($account['site'], "https://") === false)
                $account['site'] = 'http://' . $account['site'];

            //check if company exists
            $companyDB = $this->getDoctrine()
                ->getRepository('AppBundle:Company')
                ->findOneBy(['account_name' => $account['name']]);

            if ($companyDB) return $this->_result(['code' => '-1', 'mess' => 'company_exists']);

            $activateCode = rand(11111111,99999999);

            //add company
            $companyDB = new Company();
            $companyDB
                ->setAccountName($account['name'])
                ->setCompanyName($account['company'])
                ->setUrl($account['site'])
                ->setCountry($account['country'])
                ->setTimezone($account['timezone'])
                ->setActive('N')
                ->setBanned('N')
                ->setRegisteredAt(time())
                ->setUpdatedAt(time())
                ->setActivateCode($activateCode);

            $em = $this->getDoctrine()->getManager();
            $em->persist($companyDB);
            $em->flush();

            $companyId = $companyDB->getId();

            //add user
            $usersDB = new Users();
            $usersDB
                ->setCompanyId($companyId)
                ->setEmail($user['email'])
                ->setName($user['name'])
                ->setPasswd(md5($user['passwd']))
                ->setTimezone($account['timezone'])
                ->setAdmin('Y');

            $em->persist($usersDB);
            $em->flush();

            //send mail
            $message = \Swift_Message::newInstance()
                ->setSubject('inWorkFlow registration')
                ->setFrom(['info@inworkflow.pp.ua' => 'inWorkFlow'])
                ->setTo([$user['email'] => $user['name']])
                ->setBody(
                    $this->renderView( 'emails/registration.html.twig',
                        ['user' => $user, 'company' => $account, 'activateCode' => $activateCode]
                    ),
                    'text/html'
                );

            $this->get('mailer')->send($message);

            return $this->_result(['code' => '1']);
        }
        else
        {
            return $this->redirect('/', 301);
        }


    }

    /**
     * @Route("/get_time_zone", name="getTimeZone")
     */
    public function getTimeZone(Request $request)
    {
        if ($request->getMethod() == 'POST')
        {
            $countryCode = $request->request->get('countryCode');
            $zones = $this->getDoctrine()
                ->getRepository('AppBundle:Timezone')
                ->findBy(['country_code' => $countryCode], ['zone_name' => 'ASC']);

            return $this->_result(['zones' => $zones]);
        }
    }

    protected function _result(Array $returnMessage)
    {
        $response = json_encode($returnMessage);
        return new Response($response);
    }
}
