<?php
function setNull($bdd) {
    $bdd->query('DELETE FROM attendances');
    $users = $bdd->query('SELECT id FROM users');
    $projects = $bdd->query('SELECT id FROM projects');
    foreach ($projects as $pj) {
        foreach ($users as $us) {
            $bdd->query('INSERT INTO attendances (id_project,id_user,count) VALUES ('.$pj['id'].','.$us['id'].',0)');
        }
    }
}

function newDay($bdd){

}

function getMinAttendances($bdd){
    $result = $bdd->query("select u.* from attendances a, users u
            where a.count = (select min(count) from attendances where id_project=".$i.")
            AND a.id_project=".$i." AND u.id=a.id_user");
    $array = array();
    foreach ($result as $rs) {
        $array[] = $rs['id'];
    }
    return $array;
}

function getMaxAttendances($bdd){
    $result = $bdd->query("select u.* from attendances a, users u
            where a.count = (select max(count) from attendances where id_project=".$i.")
            AND a.id_project=".$i." AND u.id=a.id_user ORDER BY RAND()");
    $array = array();
    foreach ($result as $rs) {
        $array[] = $rs['id'];
    }
    return $array;
}

function getRandom($j,$array1,$array2){
    $g = rand(0, $j - 1);
    $h = rand(0, $j - 1);
    $rand = array($array1[$g], $array2[$h]);
    return $rand;
}

function insertActivitie($bdd,$date,$val1,$val2,$i){
    $bdd->query("INSERT INTO activities
    VALUES ('" . $date . "'," . $val1 . "," . $val2 . "," . $i . ")");
}

function updateAttendance($bdd,$val,$i){
    $result = $bdd->query("SELECT count FROM attendances
    WHERE id_user=" . $val . " AND id_project=" . $i);
    $line = $result->fetch_assoc();
    $count = $line['count'] + 1;
    $bdd->query("UPDATE attendances SET count=" . $count . "
    WHERE id_user=" . $val . " AND id_project=" . $i);
}

function checkActivities($bdd,$val1,$val2,$date){
    $result1 = $bdd->query("select * from activities
                  where (id_user1=" . $val1 . " OR id_user2=" . $val1 . ")
                  AND date='" . $date . "'");
    $result2 = $bdd->query("select * from activities
                  where (id_user1=" . $val2 . " OR id_user2=" . $val2 . ")
                  AND date='" . $date . "'");
    if ($result1->num_rows == 0 AND $result2->num_rows == 0) {
        return true;
    }
    else{
        return false;
    }
}

function displayActivities($bdd){

}