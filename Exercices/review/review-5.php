<?php

    $T1 = array('Dev','Dev','Dev','Dev');
    $T2 = array('101','102','103','104');

    $t= array_merge($T1,$T2);

    print_r($t);

    echo '<br>'. sizeof($t);

?>