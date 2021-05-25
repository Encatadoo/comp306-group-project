<?php


function check_cid($cid){
    return is_numeric($cid);
}

function check_name($name){
    return ctype_alpha($name) and (strlen($name) < 35);
}

function check_country_code($country_code){
    return ctype_alpha($country_code) and  (strlen($str) < 3);
}

function check_district($district){
    return ctype_alpha($district) and (strlen($district) < 20);
}

function check_population($population){
    return is_numeric($population);
}

function get_city_info($conn,$cid){

    if ($result = mysqli_query($conn, "SELECT * FROM city WHERE ID=" . $cid )) {
        return $result;
    }

    #What happends if 'if condition' fails.

}


function print_table($table_name, $result){
    if ($table_name === 'city'){

        ?><br>

        <table border='1'>

        <tr>

        <th>ID</th>

        <th>Name</th>

        <th>Country Code</th>

        <th>District</th>

        <th>Population</th>

        </tr>

        <?php


        foreach($result as $row){

            echo "<tr>";

            echo "<td>" . $row['ID'] . "</td>";

            echo "<td>" . $row['Name'] . "</td>";

            echo "<td>" . $row['CountryCode'] . "</td>";

            echo "<td>" . $row['District'] . "</td>";

            echo "<td>" . $row['Population'] . "</td>";

            echo "</tr>";
        }

        echo "</table>";
    }
}

function insert_city($conn,$cid, $name, $country_code, $district, $population){


    $sql = "INSERT INTO city(ID, Name, CountryCode, District, Population) VALUES('$cid', '$name', '$country_code', '$district','$population');";
    if ($conn->query($sql) === TRUE) { #We used different function to run our query.
        echo "<br>Record updated successfully<br>";
    } else {
        echo "<br>Error updating record: " . $conn->error . "<br>";
    }
}

function remove_city($conn,$cid){
    $sql = "DELETE FROM city WHERE ID='$cid'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

}

function manipulate_city($conn,$cid,$name){

    $sql = "UPDATE city SET Name='$name' WHERE ID='$cid'" ;
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

}