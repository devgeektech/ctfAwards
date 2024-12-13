<?php
// app/Models/WpUser.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class WPUser extends Authenticatable
{
    protected $table = 'wp_users'; // The table name
    protected $primaryKey = 'ID'; // The primary key of the table (if different from 'id')

    // Define the columns that can be mass-assigned
    protected $fillable = [
        'user_login', 'user_pass', // Add other fields you need
    ];

    // Optionally define password column name
    public function getAuthPassword()
    {
        return $this->user_pass; // The column storing the password
    }

    // Optionally define a column for the username
    public function getAuthIdentifierName()
    {
        return 'user_login'; // The column storing the username
    }

    // Optionally, define a method to authenticate user by username
    public function getAuthIdentifier()
    {
        return $this->user_login; // The column storing the username
    }
}
