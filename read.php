<?php

require_once 'include/dbConnect.php';
require_once 'include/functions.php';

$result = get_city_info($conn,4000);
print_table('city',$result);