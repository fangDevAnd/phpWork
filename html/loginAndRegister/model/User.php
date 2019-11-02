<?php


class User
{

    private $user;

    private $password;

    private $sex;

    /**
     * User constructor.
     * @param $user
     * @param $password
     * @param $sex
     */
    public function __construct($user, $password, $sex)
    {
        $this->user = $user;
        $this->password = $password;
        $this->sex = $sex;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param mixed $sex
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    }






}