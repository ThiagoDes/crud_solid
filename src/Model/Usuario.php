<?php

namespace Src\Model;

use Src\Helpers\Util;

class Usuario
{

    private $id;
    private $name;
    private $login;
    private $password;    
    private $cpf;
    private $address;
    private $number;
    private $district;
    private $cep;
    private $city;
    private $phone;
    private $email;
    private $date_register;
    private $status;
    private $last_access_date;
    private $deleted;

    public function __construct($id = null, $name = null, $login = null, $password = null, $cpf = null, $address = null, $number = null, $district = null, $cep = null, $city = null, $phone = null, $email = null, $date_register = null, $status = null, $last_access_date = null, $deleted = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
        $this->cpf = $cpf;
        $this->address = $address;
        $this->number = $number;
        $this->district = $district;
        $this->cep = $cep;
        $this->city = $city;
        $this->phone = $phone;
        $this->email = $email;
        $this->date_register = $date_register;
        $this->status = $status;
        $this->last_access_date = $last_access_date;
        $this->deleted = $deleted;
    }
    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of login
     */ 
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login
     *
     * @return  self
     */ 
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of cpf
     */ 
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set the value of cpf
     *
     * @return  self
     */ 
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Get the value of address
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */ 
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of number
     */ 
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set the value of number
     *
     * @return  self
     */ 
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get the value of district
     */ 
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set the value of district
     *
     * @return  self
     */ 
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get the value of cep
     */ 
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set the value of cep
     *
     * @return  self
     */ 
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */ 
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of date_register
     */ 
    public function getDate_register()
    {
        return $this->date_register;
    }

    /**
     * Set the value of date_register
     *
     * @return  self
     */ 
    public function setDate_register($date_register)
    {
        $this->date_register = $date_register;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of last_access_date
     */ 
    public function getLast_access_date()
    {
        return $this->last_access_date;
    }

    /**
     * Set the value of last_access_date
     *
     * @return  self
     */ 
    public function setLast_access_date($last_access_date)
    {
        $this->last_access_date = $last_access_date;

        return $this;
    }

    /**
     * Get the value of deleted
     */ 
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set the value of deleted
     *
     * @return  self
     */ 
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }
}