<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\CRM\Entities\Account;
use Modules\Core\Entities\User;
use App\Models\Team;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Account
        $account = Account::create([
            'name' => 'Default',
        ]);

        // Admin
        $admin = User::create([
            'account_id' => $account->id,
            'username' => 'admin',
            'slug' => 'admin',
            'first_name' => Str::random(10),
            'last_name' => Str::random(10),
            'email' => 'admin@example.com',
            'password' => Hash::make('4dm1n1str4t0r'),
            'is_staff' => false,
            'is_superuser' => true,
            'is_active' => true
        ]);

        $this->createTeam($admin);

        // Staff
        $staff = User::create([
            'account_id' => $account->id,
            'username' => 'staff',
            'slug' => 'staff',
            'first_name' => Str::random(10),
            'last_name' => Str::random(10),
            'email' => 'staff@example.com',
            'password' => Hash::make('St4ff'),
            'is_staff' => true,
            'is_superuser' => false,
            'is_active' => true
        ]);

        $this->createTeam($staff);
    }

    protected function createTeam($user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->first_name . $user->last_name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
