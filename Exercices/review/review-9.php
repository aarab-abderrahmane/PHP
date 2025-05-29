
<?php

$array = [
    
    'name' => 'john',
    'age' => 30 ,    
    'hobbies' => [
        '1' => 'sport'
    ]

];

echo $array['name']."\n";
echo $array['hobbies']['1']."\n";
// print_r($array)


$array_2 = ['apple',"banana"];
$array_2[]="orange";
array_pop($array_2); // delete last 
array_unshift($array_2,'orange');
print_r($array_2);

array_shift($array_2) ;// delete first

$array_2['1']="mango"; // edit by index

print_r($array_2);

//edit by value 
foreach($array_2 as &$fruit){ // & : reference , ex : (as .. $array_2[0])
    if($fruit === "mango"){
        $fruit = "banana" ; //edit
    }
}

unset($fruit) ; // to remove the reference


print_r($array_2);

array_push($array_2,'banana'); // add at least 

// delete by index
unset($array_2[1]);
print_r($array_2);


// reindex:
$array_2 = array_values($array_2);
print_r($array_2);


// delete by value 
$array_2 = array_diff($array_2,['banana']);

print_r($array_2);


$array_3 = ['1','10','9'];
echo in_array($array_3,['abdu/1']);

$data = "red,green,blue";
$colors = explode(',',$data);
print_r($colors);

$colors = ['red','green','blue'];
$colors = implode('|',$colors);
print_r($colors)

?>