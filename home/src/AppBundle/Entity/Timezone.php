<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="timezone")
 */
class Timezone
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    public $country_code;

    /**
     * @ORM\Column(type="string", length=50)
     */
    public $zone_name;

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
     * Set countryCode
     *
     * @param string $countryCode
     *
     * @return Timezone
     */
    public function setCountryCode($countryCode)
    {
        $this->country_code = $countryCode;

        return $this;
    }

    /**
     * Get countryCode
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * Set zoneName
     *
     * @param string $zoneName
     *
     * @return Timezone
     */
    public function setZoneName($zoneName)
    {
        $this->zone_name = $zoneName;

        return $this;
    }

    /**
     * Get zoneName
     *
     * @return string
     */
    public function getZoneName()
    {
        return $this->zone_name;
    }
}
