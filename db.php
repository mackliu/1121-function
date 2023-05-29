<?php 
echo "<pre>";
print_r(find('options',23));
echo "</pre>";
/* echo "<pre>";
print_r(all('options'));
echo "</pre>"; */

//update('options',
//        ['description'=>'50萬','total'=>200],
//        8);

//insert('options',['description'=>'60萬','subject_id'=>5,'total'=>0]);
del('options',21);

function all($table){
    $dsn="mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo=new PDO($dsn,'root','');

    $sql="select * from $table ";

    $rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    return $rows;
}

function find($table,$id){

    $dsn="mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo=new PDO($dsn,'root','');

    $sql="select * from `$table`  where `id`='$id' ";

    $row=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

    return $row;
}

//一次更新一筆
function update($table,$cols,$id){
    $dsn="mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo=new PDO($dsn,'root','');

    //['subject'=>'今天天氣很好吧?',
    // 'open_time'=>'2023-05-29',
    // 'close_time'=>'2023-06-05',
    //]
    $tmp='';
    foreach($cols as $key => $value){

       $tmp .= "`$key`='$value',";

    }

    //刪除前後的多餘逗號','
    $tmp=trim($tmp,',');

    //`subject`='今天天氣很好吧?',`open_time`='2023-05-29',`close_time`='2023-06-05'

    $sql="update `$table` set  $tmp where `id`='$id'";

    $result=$pdo->exec($sql);


    return $result;
}

function insert($table,$cols){
    $dsn="mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo=new PDO($dsn,'root','');
    $col=array_keys($cols);

/*     $sql ="insert into $table (`";
    $sql .=join("`,`", $col);
    $sql .="`) values('";
    $sql .=join("','",$cols);
    $sql .="')"; */

    $sql="insert into $table (`" . join("`,`", $col) . "`) values('".join("','",$cols)."')";
    //echo $sql;

    $result=$pdo->exec($sql);

    return $result;
}


function del($table,$id){
    $dsn="mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo=new PDO($dsn,'root','');

    $sql="delete from `$table` where `id`='$id'";

    return $pdo->exec($sql);
}
?>