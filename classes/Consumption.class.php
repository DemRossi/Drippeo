<?php

class Consumption
{
    public static function limit($id)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare('select user_limit from product_settings where user_id = :id ');
        $statement->bindValue(':id', $id);
        $statement->execute();

        $array = $statement->fetch(PDO::FETCH_COLUMN);

        return $array;
    }

    public static function day($id)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare('select user_limit from product_settings where user_id = :id ');
        $statement->bindValue(':id', $id);
        $statement->execute();

        $array = $statement->fetch(PDO::FETCH_COLUMN);

        return $array;
    }

    public static function tipsLimit($id)
    {
        $limit = self::limit($id);
        $used = self::calcTotalDay();

        if ($used > $limit / 2) {
            $result = "Be careful you're halfway of your daily consumption.";
        } elseif ($used > $limit) {
            $result = 'Oh no! You used more than your limit.';
        } elseif ($used == $limit) {
            $result = 'Close call! Try to do better next time';
        } elseif ($used < $limit / 2) {
            $result = "Good job, you're still under the half of your limit.";
        } elseif (date('H') == 23) {
            if ($used >= $limit) {
                $result = ' What a day! You used a lot of water. Why is that? Check where your water went.';
            }
        } elseif ($used == 0) {
            $result = 'No water used today.';
        }

        return $result;
    }

    public static function tipsAlgemeen($id)
    {
        $conn = Db::getInstance();
        //bad gebruik
        /*
         $stm = $conn->prepare('');
         $stm->bindValue(':id', $id);
         $stm->execute();
         $baths = $stm->fetch(PDO::FETCH_COLUMN);*/

        //douche gebruik
        $statement = $conn->prepare("select comsumption.duration 
        from users,actions,comsumption,action_list,productcode 
        where users.id=:id  and actions.user_id = users.id and action_list.name LIKE ' % shower % '
        and users.productcode_id= productcode.id and comsumption.productcode = productcode.productCode");
        $statement->bindValue(':id', $id);
        $statement->execute();
        $showerTime = $statement->fetch(PDO::FETCH_COLUMN);
        $showerMin = $showerTime / 3600;

        /* if ($baths > 3) {
             $result = 'You take a lot of baths. If you take a shower more it will cost you less';
         } else */if ($showerMin < 5) {
            $result = "It's great you're showers are less then 5 min. That way you save a lot of water";
        } elseif ($showerMin > 10) {
            $result = 'Shower times taking more than 10 min. Try to shorten them';
        } else {
            return $result;
        }
    }

    // get data of today
    public static function dataToday($productCode)
    {
        $conn = Db::getInstance();
        $stmnt = $conn->prepare('SELECT comsumption.productcode,`avg`,`duration`, `date`,productcode_user.email FROM `comsumption`,productcode_user WHERE (DATE(`date`) = CURDATE()) && (comsumption.productcode = :productCode) && (productcode_user.productCode = comsumption.productcode)');
        $stmnt->bindParam(':productCode', $productCode);
        $stmnt->execute();

        $result = $stmnt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function calcTotalDay()
    {
        $raw = self::dataToday($_SESSION['user']['productcode']);
        $totals = 0;
        for ($i = 0; $i < count($raw); ++$i) {
            $dur = $raw[$i]['duration'] / 3600;
            $total = $raw[$i]['avg'] * $dur;
            $totals += $total;
        }
        // self::saveDailyTotal($total);

        return $totals;
    }

    public static function calcTotalMinut($data)
    {
        $total = 0;

        $dur = $data['duration'] / 3600;
        $total = $data['avg'] * $dur;

        return $total;
    }

    // public function saveDailyTotal($total)
    // {
    //     $total = self::calcTotalDay();

    //     $conn = Db::getInstance();
    //     $checkStmnt = $conn->prepare('select * from `dailytotal` where (user_id = :user_id) and (DATE(`date`) = CURDATE())');
    //     $checkStmnt->bindParam(':user_id', $_SESSION['user']['id']);
    //     $checkStmnt->execute();

    //     $checkRes = $checkStmnt->fetchAll(PDO::FETCH_ASSOC);

    //     if (!is_array($checkRes)) {
    //         $insertStmnt = $conn->prepare('insert into `dailytotal` (`user_id`, `total`, `date) values (:user_id, :total, NOW())');
    //         $insertStmnt->bindParam(':user_id', $_SESSION['user']['id']);
    //         $insertStmnt->bindParam(':total', $total);
    //         $insertStmnt->execute();
    //     } else {
    //         $updateStmnt = $conn->prepare('update `dailytotal` set `user_id`=:user_id, `total`=:total, `date`=NOW())');
    //         $updateStmnt->bindParam(':user_id', $_SESSION['user']['id']);
    //         $updateStmnt->bindParam(':total', $total);
    //         $updateStmnt->execute();
    //     }
    // }

    public static function calcTotalYear()
    {
        $conn = Db::getInstance();
        $year = date('Y');

        $stmnt = $conn->prepare('SELECT comsumption.avg, comsumption.duration FROM `comsumption`,productcode_user 
        WHERE (YEAR(`date`) = :year) && (comsumption.productcode = :productCode) && (productcode_user.productCode = comsumption.productcode)');
        $stmnt->bindParam(':productCode', $_SESSION['user']['productcode']);
        $stmnt->bindParam(':year', $year);
        $stmnt->execute();
        $resultArray = $stmnt->fetchAll(PDO::FETCH_ASSOC);

        $totalYear = 0;
        for ($i = 0; $i < count($resultArray); ++$i) {
            $dur = $resultArray[$i]['duration'] / 3600;
            $total = $resultArray[$i]['avg'] * $dur;
            $totalYear += $total;
        }
        // self::saveDailyTotal($total);

        return $totalYear;
    }

    // VERGELIJKING MET ANDEREN
    // 1. De grootste verbruiker(zelfde aantal huishouden)

    public static function bigSpender()
    {
        $conn = Db::getInstance();
        $year = date('Y');
        //Hoeveel mensen wonen er bij u zelf
        $stm = $conn->prepare('SELECT residents FROM product_settings WHERE user_id = :id ');
        $stm->bindParam(':id', $_SESSION['user']['id']);
        $stm->execute();
        $residents = $stm->fetch(PDO::FETCH_COLUMN);

        // Selecteer grootste verbruiker met zelfde resident

        $statement = $conn->prepare('SELECT comsumption.avg, comsumption.duration,users.id FROM product_settings,comsumption,users,productcode WHERE product_settings.residents = :yourResidents AND YEAR(comsumption.date) = :year AND productcode.productCode=comsumption.productcode AND users.productcode_id=productcode.id');
        $statement->bindParam(':yourResidents', $residents);
        $statement->bindParam(':year', $year);
        $statement->execute();

        $resultArray = $statement->fetchAll(PDO::FETCH_ASSOC);
        $users = $resultArray['id'];
        foreach ($users as $user) {
        }
        /*$totalYear = 0;
        for ($i = 0; $i < count($resultArray); ++$i) {
            $dur = $resultArray[$i]['duration'] / 3600;
            $total = $resultArray[$i]['avg'] * $dur;
            $totalYear += $total;
        }*/

        return   $resultArray;
    }

    // 2. Minste verbruiker (zelfde aantal huishouden)
    public static function leastSpender()
    {
        $conn = Db::getInstance();
        //Hoeveel mensen wonen er bij u zelf
        $stm = $conn->prepare('Select residents from product_settings where user_id = :id ');
        $stm->bindParam(':id', $_SESSION['user']['id']);
        $stm->execute();
        $residents = $stm->fetch(PDO::FETCH_COLUMN);
    }
}
