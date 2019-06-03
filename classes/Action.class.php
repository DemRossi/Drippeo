<?php
    class Action
    {
        private $actionId;
        private $userId;
        private $total;
        private $timestamp;

        /**
         * Get the value of actionId.
         */
        public function getActionId()
        {
            return $this->actionId;
        }

        /**
         * Set the value of actionId.
         *
         * @return self
         */
        public function setActionId($actionId)
        {
            $this->actionId = $actionId;

            return $this;
        }

        /**
         * Get the value of userId.
         */
        public function getUserId()
        {
            return $this->userId;
        }

        /**
         * Set the value of userId.
         *
         * @return self
         */
        public function setUserId($userId)
        {
            $this->userId = $userId;

            return $this;
        }

        /**
         * Get the value of timestamp.
         */
        public function getTimestamp()
        {
            return $this->timestamp;
        }

        /**
         * Set the value of timestamp.
         *
         * @return self
         */
        public function setTimestamp($timestamp)
        {
            $this->timestamp = $timestamp;

            return $this;
        }

        /**
         * Get the value of total.
         */
        public function getTotal()
        {
            return $this->total;
        }

        /**
         * Set the value of total.
         *
         * @return self
         */
        public function setTotal($total)
        {
            $this->total = $total;

            return $this;
        }

        public static function getActionList()
        {
            $conn = Db::getInstance();
            $stmnt = $conn->prepare('select * from action_list');
            $stmnt->execute();
            $result = $stmnt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }

        public function saveAction()
        {
            $conn = Db::getInstance();
            $stmnt = $conn->prepare('insert into `actions` (action_id, user_id, total, date) values(:actionId, :userId, :total, :timestamp)');
            $stmnt->bindParam(':actionId', $this->actionId);
            $stmnt->bindParam(':userId', $this->userId);
            $stmnt->bindParam(':total', $this->total);
            $stmnt->bindParam(':timestamp', $this->timestamp);
            $stmnt->execute();
        }

        public static function dailyActions($id)
        {
            $conn = Db::getInstance();
            $stm = $conn->prepare('SELECT actions.*, action_list.name,action_list.icon  FROM `actions`, `action_list` WHERE (action_list.id = action_id) AND (actions.user_id = :userId) AND (DATE(actions.date) = CURDATE())');
            $stm->bindValue(':userId', $id);

            $stm->execute();
            $actions = $stm->fetchAll(PDO::FETCH_ASSOC);

            return  $actions;
        }
    }
