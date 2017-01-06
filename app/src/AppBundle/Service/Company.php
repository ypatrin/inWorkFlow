<?php

namespace AppBundle\Service;

class Company
{
    protected $em;
    protected $doctrine;
    protected $accountName;

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;

        $domainParts = explode('.', $_SERVER['HTTP_HOST']);
        $this->accountName = $domainParts[0];
    }

    public function getCompany()
    {
        $company = $this->em->getRepository('AppBundle:Company')->findOneBy(['account_name' => $this->accountName]);
        return $company;
    }

    public function isActive()
    {
        $company = $this->getCompany();

        if (!$company)
            return false;

        if ($company->getActive() == "N")
            return false;

        return true;
    }
}