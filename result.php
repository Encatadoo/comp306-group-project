<?php

require_once 'include/dbConnect.php';
require_once 'include/functions.php';

if (isset($_POST['insert'])){

    $cid = $_POST["cid_insert"];
    $name = $_POST["name_insert"];
    $country_code = $_POST["country_code_insert"];
    $district = $_POST["district_insert"];
    $population = $_POST["population_insert"];

    if(check_cid($cid) !== true){
        exit("Wrong cid value");
    }

    if(check_name($name) !== true){
        exit("Wrong name");
    }

    if(check_country_code($country_code) !== true){
        exit("Wrong country code");
    }

    if(check_district($district) !== true){
        exit("Wrong district");
    }

    if(check_population($population) !== true){
        exit("Wrong population");
    }

    $result = get_city_info($conn,$cid);
    echo "Returned rows are: " . mysqli_num_rows($result);
    print_table('city', $result);
    mysqli_free_result($result);
    insert_city($conn,$cid, $name, $country_code, $district, $population);
    $result = get_city_info($conn,$cid);
    echo "Returned rows are: " . mysqli_num_rows($result);
    print_table('city', $result);
    mysqli_free_result($result);
}


if (isset($_POST['remove'])){

    $cid = $_POST["cid_remove"];

    if(check_cid($cid) !== true){
        exit("Wrong cid value");
    }
    $result = get_city_info($conn,$cid);
    echo "Returned rows are: " . mysqli_num_rows($result);
    print_table('city', $result);
    mysqli_free_result($result);
    remove_city($conn,$cid);
    $result = get_city_info($conn,$cid);
    echo "Returned rows are: " . mysqli_num_rows($result);
    print_table('city', $result);
    mysqli_free_result($result);
}


if (isset($_POST['manipulate'])){

    $cid = $_POST["cid_manipulate"];
    $name = $_POST["name_insert"];

    if(check_cid($cid) !== true){
        exit("Wrong cid value");
    }


    get_city_info($conn,$cid);



    manipulate_city($conn,$cid,$name);
    get_city_info($conn,$cid);
}


