<?php include("config.php");
include("functions.php");?>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
    <?php
    //setNull($bdd);
    $date=date("Y-m-d");
    for($i=1;$i<=5;$i++) {
        $result = $bdd->query("select u.* from attendances a, users u
            where a.count = (select min(count) from attendances where id_project=".$i.")
            AND a.id_project=".$i." AND u.id=a.id_user");
        $array = array();
        foreach ($result as $rs) {
            $array[] = $rs['id'];
        }
        $j=$result->num_rows;
        if($j==1){
            $resultmax = $bdd->query("select u.* from attendances a, users u
            where a.count = (select max(count) from attendances where id_project=".$i.")
            AND a.id_project=".$i." AND u.id=a.id_user ORDER BY RAND()");
            $arraymax = array();
            foreach ($resultmax as $rs) {
                $arraymax[] = $rs['id'];
            }
            $b = true;
            while ($b) {
                $g = rand(0, $j - 1);
                $h = rand(0, $j - 1);
                $now = array($array[$g], $arraymax[$h]);
                if ($i == 1 OR $i == 5) {
                    $bdd->query("INSERT INTO activities
                    VALUES ('" . $date . "'," . $array[$g] . "," . $arraymax[$h] . "," . $i . ")");
                    $result5 = $bdd->query("SELECT count FROM attendances
                    WHERE id_user=" . $array[$g] . " AND id_project=" . $i);
                    $line2 = $result5->fetch_assoc();
                    $count = $line2['count'] + 1;
                    $bdd->query("UPDATE attendances SET count=" . $count . "
                    WHERE id_user=" . $array[$g] . " AND id_project=" . $i);
                    $result6 = $bdd->query("SELECT count FROM attendances
                    WHERE id_user=" . $arraymax[$h] . " AND id_project=" . $i);
                    $line2 = $result6->fetch_assoc();
                    $count = $line2['count'] + 1;
                    $bdd->query("UPDATE attendances SET count=" . $count . "
                    WHERE id_user=" . $arraymax[$h] . " AND id_project=" . $i);
                    $b = false;
                } else {
                    $result2 = $bdd->query("select * from activities
                  where (id_user1=" . $array[$g] . " OR id_user2=" . $array[$g] . ")
                  AND date='" . $date . "'");
                    $result3 = $bdd->query("select * from activities
                  where (id_user1=" . $arraymax[$h] . " OR id_user2=" . $arraymax[$h] . ")
                  AND date='" . $date . "'");
                    if ($result2->num_rows == 0 AND $result3->num_rows == 0) {
                        $bdd->query("INSERT INTO activities
                      VALUES ('" . $date . "'," . $array[$g] . "," . $arraymax[$h] . "," . $i . ")");
                        $result5 = $bdd->query("SELECT count FROM attendances
                    WHERE id_user=" . $array[$g] . " AND id_project=" . $i);
                        $line2 = $result5->fetch_assoc();
                        $count = $line2['count'] + 1;
                        $bdd->query("UPDATE attendances SET count=" . $count . "
                    WHERE id_user=" . $array[$g] . " AND id_project=" . $i);
                        $result6 = $bdd->query("SELECT count FROM attendances
                    WHERE id_user=" . $arraymax[$h] . " AND id_project=" . $i);
                        $line2 = $result6->fetch_assoc();
                        $count = $line2['count'] + 1;
                        $bdd->query("UPDATE attendances SET count=" . $count . "
                    WHERE id_user=" . $arraymax[$h] . " AND id_project=" . $i);
                        $b = false;
                    }
                }
            }
            $result4 = $bdd->query("select p.name as pname, u1.name as 1name, u2.name as 2name
            from projects p,users u1, users u2
            where p.id=" . $i . " AND u1.id=" . $array[$g] . " AND u2.id=" . $arraymax[$h]);
            $line = $result4->fetch_assoc();
            echo "<h1>" . $line['pname'] . "</h1><br>" . $line['1name'] . " " . $line['2name'] . "<br>";
        }
        else{
            $b = true;
            while ($b) {
                $g = rand(0, $j - 1);
                $h = rand(0, $j - 1);
                if ($g == $h) {
                    if ($h == $j - 1) {
                        $g--;
                    } else {
                        $h++;
                    }
                }
                $now = array($array[$g], $array[$h]);
                if ($i == 1 OR $i == 5) {
                    $bdd->query("INSERT INTO activities
                    VALUES ('" . $date . "'," . $array[$g] . "," . $array[$h] . "," . $i . ")");
                    $result5 = $bdd->query("SELECT count FROM attendances
                    WHERE id_user=" . $array[$g] . " AND id_project=" . $i);
                    $line2 = $result5->fetch_assoc();
                    $count = $line2['count'] + 1;
                    $bdd->query("UPDATE attendances SET count=" . $count . "
                    WHERE id_user=" . $array[$g] . " AND id_project=" . $i);
                    $result6 = $bdd->query("SELECT count FROM attendances
                    WHERE id_user=" . $array[$h] . " AND id_project=" . $i);
                    $line2 = $result6->fetch_assoc();
                    $count = $line2['count'] + 1;
                    $bdd->query("UPDATE attendances SET count=" . $count . "
                    WHERE id_user=" . $array[$h] . " AND id_project=" . $i);
                    $b = false;
                } else {
                    $result2 = $bdd->query("select * from activities
                  where (id_user1=" . $array[$g] . " OR id_user2=" . $array[$g] . ")
                  AND date='" . $date . "'");
                    $result3 = $bdd->query("select * from activities
                  where (id_user1=" . $array[$h] . " OR id_user2=" . $array[$h] . ")
                  AND date='" . $date . "'");
                    if ($result2->num_rows == 0 AND $result3->num_rows == 0) {
                        $bdd->query("INSERT INTO activities
                      VALUES ('" . $date . "'," . $array[$g] . "," . $array[$h] . "," . $i . ")");
                        $result5 = $bdd->query("SELECT count FROM attendances
                    WHERE id_user=" . $array[$g] . " AND id_project=" . $i);
                        $line2 = $result5->fetch_assoc();
                        $count = $line2['count'] + 1;
                        $bdd->query("UPDATE attendances SET count=" . $count . "
                    WHERE id_user=" . $array[$g] . " AND id_project=" . $i);
                        $result6 = $bdd->query("SELECT count FROM attendances
                    WHERE id_user=" . $array[$h] . " AND id_project=" . $i);
                        $line2 = $result6->fetch_assoc();
                        $count = $line2['count'] + 1;
                        $bdd->query("UPDATE attendances SET count=" . $count . "
                    WHERE id_user=" . $array[$h] . " AND id_project=" . $i);
                        $b = false;
                    }
                }
            }
            $result4 = $bdd->query("select p.name as pname, u1.name as 1name, u2.name as 2name
            from projects p,users u1, users u2
            where p.id=" . $i . " AND u1.id=" . $array[$g] . " AND u2.id=" . $array[$h]);
            $line = $result4->fetch_assoc();
            echo "<h1>" . $line['pname'] . "</h1><br>" . $line['1name'] . " " . $line['2name'] . "<br>";
        }
    }
    ?>
    </body>
</html>