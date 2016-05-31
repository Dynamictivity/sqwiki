<?php

$mysqli = new mysqli(getenv('SQWIKI_DATABASE_HOST'), getenv('SQWIKI_DATABASE_USERNAME'),
    getenv('SQWIKI_DATABASE_DATABASE'), getenv('SQWIKI_DATABASE_PASSWORD'));

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

/* count number of users */
if ($result = $mysqli->query("SELECT * FROM users")) {
    $numrows = $result->num_rows;

    /* print number of users to stdout */
    print($numrows);

    /* free result set */
    $result->close();
}

$mysqli->close();
