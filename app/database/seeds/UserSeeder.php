<?php

 class UserSeeder extends DatabaseSeeder
{
 public function run(){
$users = [
[
 "username" => "chris",
 "password" => Hash::make("12345"),
 "email" => "chris@example.com"
 ]
 ];

foreach ($users as $user) {
User::create($user);
 }
 }
 }