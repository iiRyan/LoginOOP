<?php

require_once('dbconn.php');


class Register extends Connection
{


    public function registeration($name, $username, $email, $password, $confirmpassword)
    {
        // To make sure all fields not empty
        // and the user does not include any harm script or spaces
        $args = func_get_args();

        $args = array_map(function ($value) {
            return trim($value);
        }, $args);

        foreach ($args as $value) {
            if (empty($value)) {
                return "All fields are required";
            }
        }

        foreach ($args as $value) {
            if (preg_match("/([<|>])/", $value)) {
                return "<> characters are not allowed";
            }
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Email is not valid";
        }

        // I used here the "prepare statement"so the communication with the database is safer. -->  "Avoid SQL injection" 


        // To make sure the Email is not exists
        $stmt = $this->conn->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        if ($data != NULL) {
            return "Email already exists, please use a different username";
        }

        if (strlen($username) > 100) {
            return "Username is to long";
        }
        // To make sure the Username is not exists
        $stmt = $this->conn->prepare("SELECT username FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        if ($data != NULL) {
            return "Username already exists, please use a different username";
        }

        if (strlen($password) > 255) {
            return "Password is to long";
        }


        if ($password != $confirmpassword) {
            return "Passwords don't match";
        }
        // hashing the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("INSERT INTO users(username, password, email) VALUES(?,?,?)");
        $stmt->bind_param("sss", $username, $hashed_password, $email);
        $stmt->execute();
        if ($stmt->affected_rows != 1) {
            return "An error occurred. Please try again";
        } else {
            return "success";
        }
    }
}
