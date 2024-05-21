
<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        $token = JWTAuth::fromUser($user);

        // Save the token to the database or return it for later use
        // For example, you can store it in an environment variable
        // or a configuration file for your API to use.
        config(['jwt.admin_token' => $token]);
    }
}
