#!/usr/bin/php
<?PHP
/*----- all the different way to print ---*/

echo "Hello World\n";
print ("Hello World\n");

$hello = "Hello";
$newl = "\n";
echo $hello." world".$newl;

/*---- calculation --- */

$result = "21" + "21";
echo "$result\n";
$ta = "7" * "6";
echo "$ta\n";

/*-------access array-------*/

$my_tab = array("zero", "wtf", "ez");
echo $my_tab[0];
echo "\n";
echo $my_tab[2]."\n";

$my_hash = array("wuw" => "wtf", "key2" => "GG");
echo $my_hash["wuw"]."\n";

echo "$my_tab\n\n"; //not gonna work lol
print_r($my_hash); 

/*-----------create function-----------*/

function my_add($p1, $p2)
{
    return $p1 + $p2;
}

echo my_add("36", "6")."\n";

/*---------if----------*/

if ($my_tab[1] == "wtf")
    echo "OK";
else
    echo "KO";
echo "\n";

if ($my_tab[2] == "wtf")
    echo "OK";
else
    echo "KO";
echo "\n";

/*-----------argc&argv------------*/

echo "$argc\n";
print_r($argv);

foreach ($my_tab as $elem)
{
    echo $elem."\n";
}

foreach ($argv as $val)
{
    echo $val."\n";
}

/*---------------explode----------------*/

$my_val = explode(";", "zero;wtd;ezzz");

foreach ($my_val as $arr)
{
    echo $arr."\n";
}

/* ---------------------www.php.net------------------------ */

?>