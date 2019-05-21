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

    public static function badkamer($id)
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

        /* if ($baths > 3) {
             $result = 'You take a lot of baths. If you take a shower more it will cost you less';
         } else */if ($showerTime < 5) {
            $result = "It's great you're showers are less then 5 min. That way you save a lot of water";
        } elseif ($showerTime > 10) {
            $result = 'Shower times taking more than 10 min. Try to shorten them';
        } else {
            return $result;
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

    public static function dailyActions($id)
    {
        $conn = Db::getInstance();
        $time = date('Y/m/d');
        $stm = $conn->prepare("select action_list.icon,action_list.name from actions,action_list where actions.user_id = :id and actions.date = $time");
        $stm->bindValue(':id', $id);

        $stm->execute();
        $actions = $stm->fetchAll(pdo::FETCH_ASSOC);

        return  $actions;
    }

    public static function vergelijking($id)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare('select product_settings.residents from product_settings where product_settings.user_id = :id');
        $statement->bindValue(':id', $id);
        $aantal = $statement->fetch(PDO::FETCH_COLUMN);

        $stm = $conn->prepare('select comsumption.avg from comsumption,product_settings where product_settings.residents = :aantal');
        $stm->bindValue(':id', $id);
        $stm->bindValue(':aantal', $aantal);
        $stm->execute();
        $andere = $stm->fetchAll(pdo::FETCH_ASSOC);

        return 'help';
    }
}
