<?php

declare(strict_types=1);

namespace App\Models;

use Nette\Database\Explorer;
use Nette\Security\Passwords;
class UserModel{
    private Explorer $database;
    private Passwords $passwords;

    public function __construct(Explorer $database, Passwords $passwords){
        $this->database = $database;
        $this->passwords = $passwords;
    }

    public function register($first_name,$last_name,$email,$tel,$password){
        $hashedPassword = $this->passwords->hash($password);
        $this->database->table('users')->insert([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'tel' => $tel,
            'password' => $hashedPassword
        ]);
    }
}