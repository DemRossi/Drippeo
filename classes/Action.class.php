<?php
    class Action
    {
        private $actionId;
        private $userId;
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

        public function saveAction()
        {
            $conn = Db::getInstance();
            $stmnt = $conn->prepare('insert into `actions` (action_id, user_id, date) values(:actionId, :userId, :timestamp)');
            $stmnt->bindParam(':actionId', $this->actionId);
            $stmnt->bindParam(':userId', $this->userId);
            $stmnt->bindParam(':timestamp', $this->timestamp);
            $stmnt->execute();
        }
    }
