<?php

    class Product
    {
        private $user_id;
        private $residents;
        private $showers;
        private $baths;
        private $toilets;
        private $sinks;
        private $outside_tap;
        private $wash_machine;
        private $dishwasher;
        private $limit;

        /**
         * Get the value of user_id.
         */
        public function getUser_id()
        {
            return $this->user_id;
        }

        /**
         * Set the value of user_id.
         *
         * @return self
         */
        public function setUser_id($user_id)
        {
            $this->user_id = $user_id;

            return $this;
        }

        /**
         * Get the value of residents.
         */
        public function getResidents()
        {
            return $this->residents;
        }

        /**
         * Set the value of residents.
         *
         * @return self
         */
        public function setResidents($residents)
        {
            $this->residents = $residents;

            return $this;
        }

        /**
         * Get the value of showers.
         */
        public function getShowers()
        {
            return $this->showers;
        }

        /**
         * Set the value of showers.
         *
         * @return self
         */
        public function setShowers($showers)
        {
            $this->showers = $showers;

            return $this;
        }

        /**
         * Get the value of baths.
         */
        public function getBaths()
        {
            return $this->baths;
        }

        /**
         * Set the value of baths.
         *
         * @return self
         */
        public function setBaths($baths)
        {
            $this->baths = $baths;

            return $this;
        }

        /**
         * Get the value of toilets.
         */
        public function getToilets()
        {
            return $this->toilets;
        }

        /**
         * Set the value of toilets.
         *
         * @return self
         */
        public function setToilets($toilets)
        {
            $this->toilets = $toilets;

            return $this;
        }

        /**
         * Get the value of sinks.
         */
        public function getSinks()
        {
            return $this->sinks;
        }

        /**
         * Set the value of sinks.
         *
         * @return self
         */
        public function setSinks($sinks)
        {
            $this->sinks = $sinks;

            return $this;
        }

        /**
         * Get the value of outside_tap.
         */
        public function getOutside_tap()
        {
            return $this->outside_tap;
        }

        /**
         * Set the value of outside_tap.
         *
         * @return self
         */
        public function setOutside_tap($outside_tap)
        {
            $this->outside_tap = $outside_tap;

            return $this;
        }

        /**
         * Get the value of wash_machine.
         */
        public function getWash_machine()
        {
            return $this->wash_machine;
        }

        /**
         * Set the value of wash_machine.
         *
         * @return self
         */
        public function setWash_machine($wash_machine)
        {
            $this->wash_machine = $wash_machine;

            return $this;
        }

        /**
         * Get the value of dishwasher.
         */
        public function getDishwasher()
        {
            return $this->dishwasher;
        }

        /**
         * Set the value of dishwasher.
         *
         * @return self
         */
        public function setDishwasher($dishwasher)
        {
            $this->dishwasher = $dishwasher;

            return $this;
        }

        /**
         * Get the value of limit.
         */
        public function getLimit()
        {
            return $this->limit;
        }

        /**
         * Set the value of limit.
         *
         * @return self
         */
        public function setLimit($limit)
        {
            $this->limit = $limit;

            return $this;
        }

        public static function infoProduct($id)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('select * from product_settings where user_id = :id ');
            $statement->bindValue(':id', $id);
            $statement->execute();

            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        public function productSettings($id)
        {
            $conn = Db::getInstance();

            if (self::infoProduct($id)) {
                $statement = $conn->prepare('UPDATE product_settings SET residents= :residents, showers = :showers, baths = :baths, toilets = :toilets, sinks= :sinks, outside_tap= :outside_tap, wash_machine =:wash_machine, dishwasher=:dishwasher, user_limit=:user_limit WHERE `user_id` = :id');
                $statement->bindParam(':id', $id);
                $statement->bindParam(':residents', $this->residents);
                $statement->bindParam(':showers', $this->showers);
                $statement->bindParam(':baths', $this->baths);
                $statement->bindParam(':toilets', $this->toilets);
                $statement->bindParam(':sinks', $this->sinks);
                $statement->bindParam(':outside_tap', $this->outside_tap);
                $statement->bindParam(':dishwasher', $this->dishwasher);
                $statement->bindParam(':wash_machine', $this->wash_machine);
                $statement->bindParam(':user_limit', $this->limit);

                $result = $statement->execute();

                return $result;
            } else {
                $statement = $conn->prepare('INSERT into product_settings (`user_id`,`residents`,`showers`,`baths`,`toilets`,`sinks`,`outside_tap`,`dishwasher`,`wash_machine`, `user_limit`) VALUES (:userId, :residents, :showers, :baths, :toilets, :sinks, :outside_tap,:dishwasher,:wash_machine,:user_limit)');
                $statement->bindParam(':userId', $id);
                $statement->bindParam(':residents', $this->residents);
                $statement->bindParam(':showers', $this->showers);
                $statement->bindParam(':baths', $this->baths);
                $statement->bindParam(':toilets', $this->toilets);
                $statement->bindParam(':sinks', $this->sinks);
                $statement->bindParam(':outside_tap', $this->outside_tap);
                $statement->bindParam(':dishwasher', $this->dishwasher);
                $statement->bindParam(':wash_machine', $this->wash_machine);
                $statement->bindParam(':user_limit', $this->limit);

                $result = $statement->execute();

                return $result;
            }
        }
    }
