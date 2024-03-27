<?php

class UserModel extends Database {
    public function getAllUsers() {
      return $this->connect()->readAll("users");
    }

    public function findUserByEmail($email) {
     $users = $this->getAllUsers();

     $singleUser = null;

     foreach($users as $user) {
        if(isset($user['email']) && $user['email'] == $email) {
          $singleUser = $user;
        }
     }

     return $singleUser;
    }

    public function getLastUserId() {
      $users = $this->getAllUsers();

      $lastUser = end($users);

      if(!isset($lastUser)) {
        return 1;
      } else {
        return $lastUser['id'];
      }
    }

    public function createUser($email, $username, $password) {
      $data = [
        "status" => false,
        "message" => "",
        "payload" => []
      ];

      try {
        if(!isset($email) || $email == "") {
          $data["message"] = "The given data is required";
          
          $data['payload'][] = [
            "type" => "email",
            "error" => "Email is required"
          ];
          
          return $data;
        }

        if(!isset($username) || $username == "") {
          $data["message"] = "The given data is required";
          
          $data['payload'][] = [
            "type" => "username",
            "error" => "Username is required"
          ];
          
          return $data;
        }

        if(!isset($password) || $password == "") {
          $data['message'] = "The given data is invalid";

          $data['payload'][] = [
            "type" => "password",
            "error" => "Password is required"
          ];

          return $data;
        }

        $sanitizedEmail = htmlspecialchars($email);

        if(!filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
          $data['message'] = "The given data is invalid";

          $data['payload'][] = [
            "type" => "email",
            "error" => "Email is invalid"
          ];

          return $data;
        }

        $sanitizedPassword = htmlspecialchars($password);

        if(!preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[$&+,:;=?@#|'<>.^*()%!-])/", $sanitizedPassword)) {
          $data['message'] = "The given data is invalid";

          $data['payload'][] = [
            "type" => "password",
            "error" => "Password must be 8 characters 
          long and have 1 uppercase letter, 1 lowercase 
          letter, 1 symbol and 1 number"
          ];
          
          return $data;
        }

        $sanitizedUsername = htmlspecialchars($username);


        if(!preg_match("/^[a-zA-Z0-9]+$/", $sanitizedUsername)) {
          $data['message'] = "The given data is invalid";

          $data['payload'][] = [
            "type" => "username",
            "error" => "Username can only be strings and numbers"
          ];
          
          return $data;
        }

        $user = $this->findUserByEmail($sanitizedEmail);

        if(isset($user)) {
          $data['message'] = "The given data is invalid";

          $data['payload'][] = [
            "type" => "both",
            "error" => "User account already exists"
          ];

          return $data;
        }

        $savedUser = $this->connect()->create("users", [
          "id"=> $this->getLastUserId() + 1,
          "email" => $sanitizedEmail,
          "username" => $sanitizedUsername,
          "password" => $sanitizedPassword
        ]);

        $data['status'] = true;
        $data['message'] = "Successfully created user";
        $data['payload'] = $savedUser;

      } catch (Exception $e) {
        $data["message"] = $e->getMessage();
      } finally {
        return $data;
      }
    }

    public function loginUser($email, $password) {
      $data = [
        "status" => false,
        "message" => "",
        "payload" => []
      ];

        try {
          if(!isset($email) || $email == "") {
            $data["message"] = "The given data is required";
            $data['payload'][] = [
              "type" => "email",
              "error" => "Email is required"
            ];
            return $data;
          }

          if(!isset($password) || $password == "") {
            $data['message'] = "The given data is invalid";
            $data['payload'][] = [
              "type" => "password",
              "error" => "Password is required"
            ];
            return $data;
          }

          $sanitizedEmail = htmlspecialchars($email);

          if(!filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
            $data['message'] = "The given data is invalid";
            $data['payload'][] = [
              "type" => "email",
              "error" => "Email is invalid"
            ];
            return $data;
          }

          $sanitizedPassword = htmlspecialchars($password);

          if(!preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[$&+,:;=?@#|'<>.^*()%!-])/", $sanitizedPassword)) {
            $data['message'] = "The given data is invalid";
            $data['payload'][] = [
              "type" => "password",
              "error" => "Password must be 8 characters 
            long and have 1 uppercase letter, 1 lowercase 
            letter, 1 symbol and 1 number"
            ];
            return $data;
          }
          
        $user = $this->findUserByEmail($sanitizedEmail);

        if(!isset($user)) {
          $data['message'] = "The given data is invalid";
            $data['payload'][] = [
              "type" => "both",
              "error" => "Invalid credentials"
            ];
            return $data;
        }

        if($user['password'] != $sanitizedPassword) {
          $data['message'] = "The given data is invalid";
            $data['payload'][] = [
              "type" => "both",
              "error" => "Invalid credentials"
            ];
            return $data;
        }

        $user['token'] = "tkn-{$user['username']}-{$user['id']}";
        $data['status'] = true;
        $data['message'] = "Successfully created user";
        $data['payload'] = $user;

        return $data;
        } catch(Exception $e) {
          $data['message'] = $e->getMessage();
          return $data;
        }
    }
}