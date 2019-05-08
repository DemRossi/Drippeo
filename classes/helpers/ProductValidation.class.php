<?php
    class ProductValidation
    {
        public static function checkProductCode($productCode)
        {
            $conn = Db::getInstance();

            $stmnt = $conn->prepare('select * from productcode where `productCode` = :code');
            $stmnt->bindParam(':code', $productCode);
            $stmnt->execute();
            $code = $stmnt->fetch(PDO::FETCH_ASSOC);

            return $code;
        }
    }
