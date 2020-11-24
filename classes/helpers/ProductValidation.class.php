<?php
    class ProductValidation
    {
        public static function getProductCode($productId)
        {
            try {
                $conn = Db::getInstance();

                $stmnt = $conn->prepare('select * from productcode where `productCode` = :code');
                $stmnt->bindParam(':code', $productId);
                $stmnt->execute();
                $code = $stmnt->fetch(PDO::FETCH_ASSOC);

                return $code;
            } catch (Trowable $t) {
                echo $t;

                return false;
            }
        }

        public static function preventDouble($productId)
        {
            try {
                $conn = Db::getInstance();

                $stmnt = $conn->prepare('select * from users where `productcode_id` = :id');
                $stmnt->bindValue(':id', $productId);
                $stmnt->execute();
                $product = $stmnt->fetch(PDO::FETCH_ASSOC);

                return $product;
            } catch (Trowable $t) {
                echo $t;

                return false;
            }
        }
    }
