<?php
  //require_once("Security.class.php");
  //require_once("Db.class.php");
  require_once 'bootstrap.php';

    class User
    {
        private $email;
        private $password;
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
            try {
                $conn = Db::getInstance();
                //var_dump($conn->errorCode());
                $statement = $conn->prepare('insert into users (`email`,`password`,`firstName`,`lastName`,`street`,`number`,`city`,`postalCode`,`phone`,`verbruikId`) values ("test@test.com", "qwerty", "test", "tester", "ergens", 45, "Antwerpen", 2000, 0475689951, "abcdef")');
                $statement->bindParam(':email', $this->email);
                $statement->bindParam(':firstname', $this->firstname);
                $statement->bindParam(':lastname', $this->lastname);
                $statement->bindParam(':username', $this->username);
                $hash = password_hash($this->password, PASSWORD_BCRYPT);
                $statement->bindParam(':password', $hash);
                $result = $statement->execute();

                return $result;
            } catch (Throwable $t) {
                return false;
            }
        }

        public function login()
        {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['username'] = $this->email;
            header('Location: index.php');
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

        public static function changePass($old, $new, $newComf, $userName)
        {
            try {
                $conn = Db::getInstance();
                $stmntPass = $conn->prepare('select * from users where username = :userName');
                $stmntPass->bindParam(':userName', $userName);
                $stmntPass->execute();
                $user = $stmntPass->fetch(PDO::FETCH_ASSOC);

                if (password_verify($old, $user['password'])) {
                    //echo "binnen";
                    if ($new == $newComf) {
                        //echo "hetzelfde";
                        $newPass = Security::hash($new);

                        //$conn = Db::getInstance();
                        $stmntPassCh = $conn->prepare('update users set `password` = :newPass where username = :userName');
                        $stmntPassCh->bindParam(':newPass', $newPass);
                        $stmntPassCh->bindParam(':userName', $userName);
                        $resultPass = $stmntPassCh->execute();

                        return $resultPass;
                    } else {
                        //echo "Wachtwoorden komen niet overeen";
                    }
                } else {
                    //echo "Foutief wachtwoord";
                }
            } catch (Throwable $t) {
                echo $t;
            }
        }
    }
