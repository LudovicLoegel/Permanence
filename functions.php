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

function newDay($bdd,$date){
    for ($i = 1; $i <= 5; $i++) {
        $arraymin=getMinAttendances($bdd,$i);
        $j=sizeof($arraymin);
        if($j==1) {
            $arraymax = getMaxAttendances($bdd, $i);
            $b = true;
            while ($b) {
                $rand=getRandomMax($j,$arraymin,$arraymax);
                if ($i == 1 OR $i == 5) {
                    insertActivity($bdd,$date,$rand[0],$rand[1],$i);
                    updateAttendance($bdd,$rand[0],$i);
                    updateAttendance($bdd,$rand[1],$i);
                    $b=false;
                }
                else{
                    if(checkActivities($bdd,$rand[0],$rand[1],$date)){
                        insertActivity($bdd,$date,$rand[0],$rand[1],$i);
                        updateAttendance($bdd,$rand[0],$i);
                        updateAttendance($bdd,$rand[1],$i);
                        $b=false;
                    }
                }
            }
        }
        else{
            $b = true;
            while ($b) {
                $rand=getRandom($j,$arraymin);
                if ($i == 1 OR $i == 5) {
                    insertActivity($bdd,$date,$rand[0],$rand[1],$i);
                    updateAttendance($bdd,$rand[0],$i);
                    updateAttendance($bdd,$rand[1],$i);
                    $b=false;
                }
                else{
                    if(checkActivities($bdd,$rand[0],$rand[1],$date)){
                        insertActivity($bdd,$date,$rand[0],$rand[1],$i);
                        updateAttendance($bdd,$rand[0],$i);
                        updateAttendance($bdd,$rand[1],$i);
                        $b=false;
                    }
                }
            }
        }
    }
}

function checkDay($bdd,$date){
    $result=$bdd->query("SELECT date FROM activities
    WHERE date='".$date."'");
    if($result->num_rows == 0){
        return true;
    }
    else{
        return false;
    }
}

function getMinAttendances($bdd,$i){
    $result = $bdd->query("select u.* from attendances a, users u
            where a.count = (select min(count) from attendances where id_project=".$i.")
            AND a.id_project=".$i." AND u.id=a.id_user");
    $array = array();
    foreach ($result as $rs) {
        $array[] = $rs['id'];
    }
    return $array;
}

function getMaxAttendances($bdd,$i){
    $result = $bdd->query("select u.* from attendances a, users u
            where a.count = (select max(count) from attendances where id_project=".$i.")
            AND a.id_project=".$i." AND u.id=a.id_user ORDER BY RAND()");
    $array = array();
    foreach ($result as $rs) {
        $array[] = $rs['id'];
    }
    return $array;
}

function getRandom($j,$array){
    $g = rand(0, $j - 1);
    $h = rand(0, $j - 1);
    if ($g == $h) {
        if ($h == $j - 1) {
            $g--;
        } else {
            $h++;
        }
    }
    $rand = array($array[$g], $array[$h]);
    return $rand;
}

function getRandomMax($j,$array1,$array2){
    $g = rand(0, $j - 1);
    $h = rand(0, $j - 1);
    $rand = array($array1[$g], $array2[$h]);
    return $rand;
}

function insertActivity($bdd,$date,$val1,$val2,$i){
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

function displayActivities($bdd,$date){
    $days_ago = date('Y-m-d', strtotime('-3 days', strtotime($date)));
    $bdd->query("DELETE FROM activities WHERE date='".$days_ago);
    $result=$bdd->query("SELECT a.date,p.name as namep,u1.name as name1,u2.name as name2
    FROM activities a,projects p,users u1,users u2
    WHERE u1.id=a.id_user1 AND u2.id=a.id_user2 AND p.id=a.id_project
    ORDER BY p.id,a.date DESC");
    $prev="";
    $i=1;
    echo "<div class='box'>";
    foreach($result as $rs){
        echo "<div class='box".$i."' >";
        if($rs['namep']==$prev){
            echo $rs['date']." : ".$rs['name1']." & ".$rs['name2']."<br>";
        }
        else{
            echo "<h1>".$rs['namep']."</h1>";
            echo $rs['date']." : ".$rs['name1']." & ".$rs['name2']."<br>";
        }
        echo "</div>";
        $prev=$rs['namep'];
        $i++;
    }
    echo "</div>";
}