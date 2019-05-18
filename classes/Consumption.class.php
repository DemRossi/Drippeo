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

    public static function tips($id)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare('select user_limit from product_settings where user_id = :id ');
        $statement->bindValue(':id', $id);
        $statement->execute();

        $stm = $conn->prepare('select sum(avg) from users,productcode,comsumption where users.id = :id AND users.productcode_id = productcode.id AND comsumption.productcode=productcode.productCode');
        $stm->bindValue(':id', $id);
        $stm->execute();
        $used = $stm->fetch(PDO::FETCH_COLUMN);

        $limit = $statement->fetch(PDO::FETCH_COLUMN);

        if ($used > $limit / 2) {
            $result = "Be careful you're halfway of your daily consumption";
        } elseif ($used > $limit) {
            $result = 'Oh no! You used more than your limit.';
        } elseif ($used == $limit) {
            $result = 'Close call! Try to do better next time';
        } elseif (date('H') == 23) {
            if ($used >= $limit) {
                $result = ' What a day! You used a lot of water. Why is that? Check where your water went.';
            }
        } elseif ($used == 0) {
            $result = 'No water used today.';
        }

        return $result;
    }

    public static function vergelijking($id)
    {
        // weekverbruik
    }

    public static function wassen($id)
    {
        //Wasverbruik

        if ($bathTimes > 3) {
            $result = 'You take a lot of baths, it is ... % of your total use. If you take a shower more 
            it will cost you less';
        } elseif ($showerTime < 5) {
            $result = "It's great you're showers are less then 5 min. That way you save a lot of water";
        }
    }

    public static function used($id)
    {
        $conn = Db::getInstance();
        $stm = $conn->prepare('select sum(avg) from users,productcode,comsumption where users.id = :id AND users.productcode_id = productcode.id AND comsumption.productcode=productcode.productCode');
        $stm->bindValue(':id', $id);
        $stm->execute();
        $used = $stm->fetch(PDO::FETCH_COLUMN);

        return  $used;
    }
}
