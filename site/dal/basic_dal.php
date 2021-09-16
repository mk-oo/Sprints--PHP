<?php
function getConnection()
{
    return mysqli_connect('localhost', 'root', '', 'blog');
}

function getRows($sql)
{
    $results = [];
    $conn = getConnection();
    if ($conn) {
        $query = mysqli_query($conn, $sql);
        mysqli_close($conn);
        while (($row = mysqli_fetch_assoc($query)) != null) {
            array_push($results, $row);
        }
    }
    return $results;
}

function getRow($sql)
{
    $results = getRows($sql);
    if (count($results) > 0)
        return $results[0];
    return null;
}

function addData($sql)
{
}

function editData($sql)
{
}

function deleteData($sql)
{
}
