<?
echo "<table class='table table-striped table-bordered table-hover' border='1px'  width='495px' height='82px'>
    <tbody><tr>
        <th><p align='center'>#</p></th>
        <th><p align='center'>Номи фан</p></th>
        <th><p align='center'>Устод</p></th>
        <th><p align='center'>Маркази тестӣ</p></th>
    </tr>";

$r=1; foreach($qarzho as $qarz){

    foreach ($lesson_table as $lesson){
        //echo $lesson['id_table'];
        if($lesson['id_table']== $qarz['id_table']){
            $name=$lesson['lesson']['0']['name'];
            $kredit=$lesson['lesson']['0']['lesson_kredit'];

            echo " <tr>
        <th>$r.</th>
        <td>$name. Kредит ба ин фан $kredit</td>
        <td colspan='2'>Ҳоло ба ин фан донишҷӯ кредит нахаридааст.</td>
    </tr>";
        }
    }
    $r++;
}


echo "</tbody></table></td>";


?>