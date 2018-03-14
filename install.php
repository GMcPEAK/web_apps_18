<?php

/*
   install.php
   author: Christopher Kramer & Grady McPeak
   description: Part of the Kramerton Public Library web app. This file is meant to be run once on the server, to automatically set up the database, tables, and load information into the tables.
   
   DO NOT FEAR THE WALL OF TEXT. READ IT CAREFULLY TO UNDERSTAND WHAT I DID.
*/

$con = new mysqli("127.0.0.1","root","root");  // connect to server and create a new mysqli connection object. Methods are called on this object with the -> operator in php (different than the dot (.) operator in java)

if ($con->connect_errno) { // if you can't connect, then halt with an error
 die("couldn't connect! mysql said: ".$con->connect_errno."<br>".$con->connect_error."Halting");
}

echo "Connected to server!<br>";

//Try to create database
if (!$con->query("CREATE DATABASE highScores")) {
  //If database creation fails, don't die - the db probably already exists
  echo "Couldn't create database: ".$con->error."<br>";
} else {
  echo "Database: highScores created<br>";
}

//Try to select the db - if this doesn't work, then die, because there's a bigger problem
if (!$con->select_db("highScores")){
 die("Error selecting database! ".$con->errno."<br>".$con->error."Halting.");
} else {
 echo "Selected database: highScores<br>";
}

// creating tables: notice all the error checking - after every table! Also, it echos lots of things so debugging is easy

// create the table of books - notice that the b_id field is the primary key and auto-increments
// had to rename the 'condition' field to 'b_condition' because condition is a reserved word in mysql
$res = $con->query("
CREATE TABLE users
(
u_id int NOT NULL AUTO_INCREMENT,
name varchar(255) NOT NULL,
password varchar(255)  NOT NULL,
PRIMARY KEY (u_id),
UNIQUE (name)
)
");

if (!$res) {
 echo "Couldn't create users table: ".$con->error."<br>";
} else {
 echo "Table created: users<br>";
}

// create the table of patrons - the UNIQUE keyword is used to make sure nobody has the same usernames
$res = $con->query("
CREATE TABLE scores
(
s_id int NOT NULL AUTO_INCREMENT,
score int NOT NULL,
gameDate date NOT NULL,
gameTime time NOT NULL,
PRIMARY KEY (s_id)
)
");

if (!$res) {
 echo "Couldn't create scores table: ".$con->error."<br>";
} else {
 echo "Table created: scores<br>";
}

/*======================================
  = inserting default data into tables =
  ======================================*/
  
// patrons
$res = $con->query("INSERT INTO users (name, password)
VALUES ('root','root')");
if (!$res) {
 echo "Failed to insert: users: root ".$con->error;
} else {
 echo "Inserted: users: root";
}
echo "<br>";

$res = $con->query("INSERT INTO users (name, password)
VALUES ('test','test')");
if (!$res) {
 echo "Failed to insert: users: test ".$con->error;
} else {
 echo "Inserted: users: test";
}
echo "<br>";

$res = $con->query("INSERT INTO scores (score, gameDate, gameTime)
VALUES (9000, '1979-02-05', '9:30')");
if (!$res) {
 echo "Failed to insert: scores: score1 ".$con->error;
} else {
 echo "Inserted: scores: score1";
}
echo "<br>";

$res = $con->query("INSERT INTO scores (score, gameDate, gameTime)
VALUES (10000, '2017-03-24', '10:30')");
if (!$res) {
 echo "Failed to insert: scores: score2 ".$con->error;
} else {
 echo "Inserted: scores: score1";
}
echo "<br>";

?>