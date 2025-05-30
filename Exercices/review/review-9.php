
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
print_r($colors);



// map function : 

$numbers = [1,12,0,-1,9];
$squared = array_map(function($n){
    return $n+10;
},$numbers);

print_r($squared);


// filter function : 
$numbers = [1,12,0,-1,9];
$filter_number = array_filter($numbers,function($n){
    return $n > 0 ; 
});

$filter_number =  array_values($filter_number); // reindex 
print_r($filter_number);

// reduce function : 
$sum = array_reduce($numbers,function($acc,$curr){ // take only two parameters

    return $acc += $curr;
},0);

echo $sum ;


echo "\n";
$acc = 0;

foreach ($numbers as  $value) {
    $acc += $value;  // $index is available here if needed
}

print_r($acc);  // Output: 10


echo"\n";

// every function : 
$numbers = [1,12,0,-1,9];
$allEven = count(array_filter($numbers,fn($n)=> $n%2 === 0 )) === count($numbers)
;echo  $allEven ? 'true' : 'false';


echo "\n";

// some function : 
$hasEven = count(array_filter($numbers, fn($n)=>$n%2===0)) > 0 ; 
echo $hasEven ? "true" : "false" ; 

$sum = array_sum($numbers);
echo $sum;


// merge arrays
$a = [1, 2];
$b = [3, 4 ,3];

$merged = array_merge($a,$b); // $a <= $b
$merged2 = array_merge($b,$a);

print_r($merged);
print_r($merged2);

print_r(array_values(array_unique($merged2))); // unique => remove duplicates



// search for a value : 
$colors = ['red', 'green', 'blue'];

if (in_array('green', $colors)) {
    echo "Found green!";
}


// search and return key (default index)
$names = ['John', 'Jane', 'Alice'];
$key = array_search("Alice",$names);
echo "\n".$key;



// replace array (modify)

$new_names = array_replace($names,[1=>'abdulrahman']);
print_r($new_names);


// get all keys / values : 
$assoc = ['name' => 'John', 'age' => 30];
$keys = array_keys($assoc);
$values = array_values($assoc);

print_r($values);


// get values from a column :

$people = [
    ['id' => 1, 'name' => 'Alice'],
    ['id' => 2, 'name' => 'Bob'],
];
$column = array_column($people,"name");
print_r($column);



// splice 
$nums = [10, 20, 30, 40, 50];
array_splice($nums,1,2); // edit the original array
print_r($nums);


// slice 
$nums = [10, 20, 30, 40, 50];
$slice = array_slice($nums,1,2); // takes the new values 
print_r($slice);


$string = "a,b,c,d";
$string = explode(',',$string);  // string to array 
print_r($string);

$array = implode('  \ ',$string); //  array to string 
print_r($array)

?>