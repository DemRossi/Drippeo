<?php
    class ProductValidation
    {
        public static function checkProductCode($productId)
        {
            $conn = Db::getInstance();

            $stmnt = $conn->prepare('select * from productcode where `productCode` = :code');
            $stmnt->bindParam(':code', $productId);
            $stmnt->execute();
            $code = $stmnt->fetch(PDO::FETCH_ASSOC);

            return $code;
        }
    }
