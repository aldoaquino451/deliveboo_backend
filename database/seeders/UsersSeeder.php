<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // password: 123123123

    $users = config('users');

    foreach ($users as $user) {
      $new_user = new User();
      $new_user->name = $user['name'];
      $new_user->lastname = $user['lastname'];
      $new_user->email = $user['email'];
      $new_user->password = $user['password'];
      $new_user->save();
    }
  }
}
