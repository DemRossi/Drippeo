<?php
    class Security
    {
        public static function hash($password)
        {
            $options = [
                'cost' => 13,
            ];

            $hash = password_hash($password, PASSWORD_DEFAULT, $options);

            return $hash;
        }
    }
