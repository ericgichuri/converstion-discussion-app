<?php

$host="localhost";
$user="root";
$pass="";

$conn=mysqli_connect($host,$user,$pass);
if(!$conn){
    echo "error".mysqli_connect_error();
}

//create database for the app
$createdb="CREATE DATABASE IF NOT EXISTS chatapp";
mysqli_query($conn,$createdb);

mysqli_select_db($conn,"chatapp");

//create table for users
$createtableusers="CREATE TABLE IF NOT EXISTS users(
    id int NOT NULL AUTO_INCREMENT,
    photo varchar(20) NOT NULL,
    fname varchar(20) NOT NULL,
    lname varchar(20) NOT NULL,
    phoneno varchar(20) NOT NULL,
    email varchar(40) NOT NULL,
    username varchar(20) NOT NULL,
    password varchar(20) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY(email),
    UNIQUE KEY(phoneno)


)";

$query_run=mysqli_query($conn,$createtableusers);
if(!$query_run){
    echo "error".mysqli_error($conn);
}

$createtablemessage="CREATE TABLE IF NOT EXISTS messages(
    id int NOT NULL AUTO_INCREMENT,
    name varchar(30) NOT NULL,
    topic varchar(30) NOT NULL,
    message varchar(500) NOT NULL,
    PRIMARY KEY (id)
)";

$query_run1=mysqli_query($conn,$createtablemessage);
if(!$query_run1){
    echo "error".mysqli_error($conn);
}

$createtablereply="CREATE TABLE IF NOT EXISTS replys(
    id int NOT NULL AUTO_INCREMENT,
    messageid int NOT NULL,
    name varchar(30) NOT NULL,
    reply varchar(500) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(messageid) REFERENCES messages(id)
)";

$query_run2=mysqli_query($conn,$createtablereply);
if(!$query_run2){
    echo "error".mysqli_error($conn);
}

?>