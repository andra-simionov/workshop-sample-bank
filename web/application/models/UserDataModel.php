<?php

class UserDataModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $username
     * @param string $password
     * @param string $email
     *
     * @return bool
     */
    public function registerUser($username, $password, $email)
    {
        $userData = [
            'Username' => $username,
            'Password' => $this->hashPassword($password),
            'Email' => $email,
        ];

        $this->db->insert('users', $userData);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function isUserRegistered(array $data)
    {
        $username = $data['username'];
        $password = $data['password'];

        $result = $this->db->select('*')
            ->from('users')
            ->where(['Username' => $username, 'Password' => $password])
            ->get()
            ->result_array();

        if (count($result) > 0) {
            return true;
        }

        return false;
    }

    /**
     * @param string $email
     * @return bool
     */
    public function emailAlreadyExists($email)
    {
        $result = $this->db->select('*')
            ->from('users')
            ->where(['Email' => $email])
            ->get()
            ->result_array();

        if (count($result) > 0) {
            return true;
        }

        return false;
    }

    /**
     * @param string $username
     * @return stdClass
     *
     * @throws Exception
     */
    public function getUserInfoByUsername($username)
    {
        $result = $this->db->select('*')
            ->from('users')
            ->where('users.Username', $username)
            ->get();

        if ($result->first_row() != NULL) {
            return $result->first_row();
        } else {
            throw new \Exception("Invalid user!");
        }
    }

    /**
     * @param int $idUser
     * @return mixed
     */
    public function getUserInfoByUserId($idUser)
    {
        $result = $this->db->select('*')
            ->from('users')
            ->where('users.IdUser', $idUser)
            ->get();

        return $result->first_row();
    }

    /**
     * @param string $password
     * @return string
     */
    public function hashPassword($password)
    {
        $salt = $this->generateSalt();

        return $salt . '.' . md5($salt . $password);
    }

    /**
     * @param string $password
     * @param string $hashedPassword
     * @return bool
     */
    public function checkPassword($password, $hashedPassword)
    {
        list($salt, $hash) = explode('.', $hashedPassword);
        $hashedFormPassword = $salt . '.' . md5($salt . $password);

        return ($hashedPassword == $hashedFormPassword);
    }

    /**
     * @param int $length
     * @return string
     */
    private function generateSalt($length = 10)
    {
        $characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $i = 0;
        $salt = "";
        while ($i < $length) {
            $salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
            $i++;
        }

        return $salt;
    }
}
