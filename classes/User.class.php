<?php
  //require_once("Security.class.php");
  //require_once("Db.class.php");
  //require_once 'bootstrap.php';

    class User
    {
        private $email;
        private $password;
        private $productCode;
        private $firstname;
        private $lastname;
        private $street;
        private $number;
        private $city;
        private $postalCode;
        private $phone;

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
            if (empty($email)) {
                throw new Exception('Email cannot be empty.');
            }

            // todo: valid email ? -> filter_var()

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
         * Get the value of productCode.
         */
        public function getProductCode()
        {
            return $this->productCode;
        }

        /**
         * Set the value of productCode.
         *
         * @return self
         */
        public function setProductCode($productCode)
        {
            $this->productCode = $productCode;

            return $this;
        }

        /**
         * Get the value of firstname.
         */
        public function getFirstname()
        {
            return $this->firstname;
        }

        /**
         * Set the value of firstname.
         *
         * @return self
         */
        public function setFirstname($firstname)
        {
            $this->firstname = $firstname;

            return $this;
        }

        /**
         * Get the value of lastname.
         */
        public function getLastname()
        {
            return $this->lastname;
        }

        /**
         * Set the value of lastname.
         *
         * @return self
         */
        public function setLastname($lastname)
        {
            $this->lastname = $lastname;

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

        public function register()
        {
            $password = Security::hash($this->password);
            $productCode = ProductValidation::getProductCode($this->productCode);
            $noDouble = ProductValidation::preventDouble($productCode['id']);
            //var_dump($test);
            if (is_array($productCode)) {
                // product code is terug gevonden in de db
                if (is_array($noDouble)) {
                    // product code is in gebruikt
                    $_SESSION['error']['title'] = 'Foutive productcode';
                    $_SESSION['error']['message'] = 'Deze product code is al reeds in gebruik. Probeer opnieuw of contacteer Drippeo.';

                    return false;
                } else {
                    // product code is niet in gebruik
                    try {
                        $conn = Db::getInstance();
                        // echo $conn;
                        //var_dump($conn->errorCode());
                        $statement = $conn->prepare('INSERT into users (`email`,`password`,`productcode_id`,`firstName`,`lastName`,`street`,`number`,`city`,`postalCode`,`phone`) values (:email, :password, :code, :firstname, :lastname, :street, :number, :city, :postalCode, :phone)');
                        $statement->bindParam(':email', $this->email);
                        $statement->bindParam(':password', $password);
                        $statement->bindParam(':code', $productCode['id']);
                        $statement->bindParam(':firstname', $this->firstname);
                        $statement->bindParam(':lastname', $this->lastname);
                        $statement->bindParam(':street', $this->street);
                        $statement->bindParam(':number', $this->number);
                        $statement->bindParam(':city', $this->city);
                        $statement->bindParam(':postalCode', $this->postalCode);
                        $statement->bindParam(':phone', $this->phone);

                        $result = $statement->execute();
                        self::setDetails();

                        return $result;
                    } catch (Throwable $t) {
                        echo $t;

                        return false;
                    }
                }
            } else {
                $_SESSION['error']['title'] = 'Geen geldige product code';
                $_SESSION['error']['message'] = 'Dit is geen geldige product code. Probeer opnieuw of contacteer Drippeo.';

                return false;
            }
        }

        private function setDetails()
        {
            // Getting database connection in class DB
            $conn = Db::getInstance();
            // Query for getting the user
            $statement = $conn->prepare('SELECT * FROM productcode_user WHERE email = :email');
            $statement->bindParam(':email', $this->email);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            $userDetails = [
                'id' => $user['id'],
                'firstname' => $user['firstName'],
                'lastname' => $user['lastName'],
                'email' => $user['email'],
                'productcode' => $user['productCode'],
            ];
            $_SESSION['user'] = $userDetails;
        }

        public function login()
        {
            $conn = Db::getInstance();
            // $email = htmlspecialchars($_POST['email']);
            // $password = $_POST['password'];

            $statement = $conn->prepare('select * from users where email = :email');
            $statement->bindParam(':email', $this->email);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if (password_verify($this->password, $user['password'])) {
                // als wachtwoorden overeen komen -> alles van user ophalen uit db en in session steken
                self::setDetails();

                return true;
            } else {
                $errorLogin = true;

                return false;
            }
        }

        public static function findByEmail($email)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('select * from users where email = :email limit 1');
            $statement->bindValue(':email', $email);
            $statement->execute();

            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        /* Check if a user exists based on a give email address */
        public static function isAccountAvailable($email)
        {
            $u = self::findByEmail($email);

            // PDO returns false if no records are found so let's check for that
            if ($u == false) {
                return true;
            } else {
                return false;
            }
        }

        public function updateAccount()
        {
            $password = Security::hash($this->password);

            try {
                $conn = Db::getInstance();
                $statement = $conn->prepare('UPDATE users SET email = :email , password = :password ,firstName = :firstname,lastName = :lastname,street= :street,number= :number,city= :city,postalCode= :postalcode, phone= :phone WHERE id = :id');
                $statement->bindParam(':id', $_SESSION['user']['id']);
                $statement->bindParam(':email', $this->email);
                $statement->bindParam(':password', $password);
                $statement->bindParam(':firstname', $this->firstname);
                $statement->bindParam(':lastname', $this->lastname);
                $statement->bindParam(':street', $this->street);
                $statement->bindParam(':number', $this->number);
                $statement->bindParam(':city', $this->city);
                $statement->bindParam(':postalcode', $this->postalCode);
                $statement->bindParam(':phone', $this->phone);

                $result = $statement->execute();
                self::setDetails();

                return $result;
            } catch (Throwable $t) {
                echo $t;

                return false;
            }
        }

        public static function info($email)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('select * from users where email = :email ');
            $statement->bindValue(':email', $email);
            $statement->execute();

            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        public static function changePassword($old, $id, $new)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('select * from users where id= :id');
            $statement->bindParam(':id', $id);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if (!empty($old && $new)) {
                if (password_verify($old, $user['password'])) {
                    // als wachtwoorden overeen komen -> alles van user ophalen uit db en in session steken
                    return true;
                } else {
                    return false;
                }
            }
        }

        public static function deleteAccount($id)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('DELETE FROM users WHERE id=:id;');
            $statement->bindParam(':id', $id);
            $statement->execute();
        }
    }
