<?php

class User
{
    private $email;
    private $password;
    private $firstName;
    private $lastName;
    private $street;
    private $number;
    private $city;
    private $postalCode;
    private $phone;

    //----------------------- GETTER & SETTER -----------------------//

    /**
     * Get the value of email.
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email.
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password.
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password.
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of firstName.
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName.
     *
     * @return self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName.
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName.
     *
     * @return self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of street.
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set the value of street.
     *
     * @return self
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get the value of number.
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set the value of number.
     *
     * @return self
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get the value of city.
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city.
     *
     * @return self
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of postalCode.
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set the value of postalCode.
     *
     * @return self
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get the value of phone.
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone.
     *
     * @return self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    //----------------------- FUNCTIES -----------------------//

    /* databank connectie hier laten werken */
    public static function getAll()
    {
        $conn = Db::getInstance();
        $result = $conn->query('select * from users ');

        // fetch all records from the database and return them as objects of this __CLASS__ (Post)
        return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    /* Login controleren */
    public static function checkLogin()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['email'])) {
            header('Location: dashboard.php');
        }
    }

    /*inloggen*/
    public static function login()
    {
        if (!empty($_POST)) {
            // email en password opvragen
            $email = $_POST['email'];
            $password = $_POST['password'];

            $conn = Db::getInstance();
            // check of rehash van password gelijk is aan hash uit db
            $statement = $conn->prepare('SELECT * from users where email = :email');
            $statement->bindParam(':email', $email);
            $result = $statement->execute();

            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $user['password'])) {
                // ja -> login
                session_start();
                $_SESSION['email'] = $email;
                header('Location: dashboard.php');
            } else {
                // nee -> error
                $error = true;
            }
        }
    }

    /* Registreren van de gebruiker*/
    public function register()
    {
        $options = [
          'cost' => 12, //2^12
          ];
        $password = password_hash($this->password, PASSWORD_DEFAULT, $options);

        try {
            // De databank aanspreken
            $conn = Db::getInstance();
            // Opslagen in de databank
            $stm = $conn->prepare('INSERT into users (email,password,firstName,lastName,street,number,city,postalCode,phone) VALUES (:email,:password,:firstname,:lastname,:street,:number,:city,:postalcode,:phone)');
            // Waarden koppelen aan invul velden (bindParam= veiligere manier)
            $stm->bindParam(':email', $this->email);
            $stm->bindParam(':password', $password);
            $stm->bindParam(':firstname', $this->firstName);
            $stm->bindParam(':lastname', $this->lastName);
            $stm->bindParam(':street', $this->street);
            $stm->bindParam(':number', $this->number);
            $stm->bindParam(':city', $this->city);
            $stm->bindParam(':postalcode', $this->postalCode);
            $stm->bindParam(':phone', $this->phone);

            // Uitvoeren
            $result = $stm->execute();

            // Gelukt = true
            return $result;
        } catch (Throwable $t) {
            // Mislukt = false
            return false;
        }
    }
}
