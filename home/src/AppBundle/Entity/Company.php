<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="company")
 */
class Company
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $account_name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $company_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $url;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $country;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    protected $timezone;

    /**
     * @ORM\Column(type="string", length=1)
     */
    protected $active;

    /**
     * @ORM\Column(type="string", length=1)
     */
    protected $banned;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    protected $registered_at;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    protected $updated_at;

    /**
     * @ORM\Column(type="integer", length=8)
     */
    protected $activate_code;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set accountName
     *
     * @param string $accountName
     *
     * @return Company
     */
    public function setAccountName($accountName)
    {
        $this->account_name = $accountName;

        return $this;
    }

    /**
     * Get accountName
     *
     * @return string
     */
    public function getAccountName()
    {
        return $this->account_name;
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     *
     * @return Company
     */
    public function setCompanyName($companyName)
    {
        $this->company_name = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->company_name;
    }

    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Company
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Company
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set active
     *
     * @param string $active
     *
     * @return Company
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return string
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set banned
     *
     * @param string $banned
     *
     * @return Company
     */
    public function setBanned($banned)
    {
        $this->banned = $banned;

        return $this;
    }

    /**
     * Get banned
     *
     * @return string
     */
    public function getBanned()
    {
        return $this->banned;
    }

    /**
     * Set registeredAt
     *
     * @param integer $registeredAt
     *
     * @return Company
     */
    public function setRegisteredAt($registeredAt)
    {
        $this->registered_at = $registeredAt;

        return $this;
    }

    /**
     * Get registeredAt
     *
     * @return integer
     */
    public function getRegisteredAt()
    {
        return $this->registered_at;
    }

    /**
     * Set updatedAt
     *
     * @param integer $updatedAt
     *
     * @return Company
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return integer
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set activateCode
     *
     * @param integer $activateCode
     *
     * @return Company
     */
    public function setActivateCode($activateCode)
    {
        $this->activate_code = $activateCode;

        return $this;
    }

    /**
     * Get activateCode
     *
     * @return integer
     */
    public function getActivateCode()
    {
        return $this->activate_code;
    }
}
