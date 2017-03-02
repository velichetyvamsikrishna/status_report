<?php
include("db.php");
mysqli_query($con,"create table approve_users(u_id varchar(200),u_type varchar(100));");
mysqli_query($con,"create table users(u_id varchar(200),pwd varchar(1000),hint varchar(250),u_type varchar(100));");
mysqli_query($con,"create table apps_data(id int(25) PRIMARY KEY,name text);");
mysqli_query($con,"create table current_tp(date DATE,name text,env varchar(100));");
mysqli_query($con,"create table previous_tp(date DATE,name text,env varchar(100));");
mysqli_query($con,"create table bugs_data(ID int(25) PRIMARY KEY,State varchar(100),Work_Item varchar(100),Resolved_Reason varchar(100),Found_Environment varchar(1000),Custom_String varchar(1000));");
mysqli_query($con,"CREATE TABLE links_report(Name varchar(1000),Total text,Active text,Fixed text,Wntfix text,External text,Duplicate text,Notrepro text,Bydesign text)");
mysqli_query($con,"CREATE TABLE totals_links(Name varchar(1000),Total text,Active text,Fixed text,Wntfix text,External text,Duplicate text,Notrepro text,Bydesign text)");
?>