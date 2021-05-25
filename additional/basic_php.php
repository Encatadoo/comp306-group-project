<!--
    COMP306-DATABASE MANAGEMENT SYSTEMS

    For More information about PHP:
        https://www.php.net/manual/en/tutorial.php
-->
<html>
<head></head>
<body>

    <?php echo "Hello World\n" ?>

    <?php
    echo $_SERVER['HTTP_USER_AGENT'];
    ?>

    <?php
    
    #strpos — Find the position of the first occurrence of a substring in a string
    /*
        strpos ( string $haystack , string $needle , int $offset = 0 ) : int|false
            Find the numeric position of the first occurrence of needle in the haystack string.
    */

    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE) {

    ?>

    <h3>strpos() must have returned non-false</h3>
    <p>You are using Internet Explorer</p>
    <?php
    } else {
    ?>

    <h3>strpos() must have returned false</h3>
    <p>You are not using Internet Explorer</p>

    <?php
    }
    ?>


</body>
</html>