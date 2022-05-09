<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ( !User::where('email','sebastian@procodigo.cl')->first() ) {

            $user = new User();
            $user->name = 'Sebastián';
            $user->email = 'sebastian@procodigo.cl';
            $user->password = bcrypt('cba7492971');
            $user->email_verified_at = now();
            $user->save();

        }

        if ( !User::where('email','admin@nazcastudios.cl')->first() ) {

            $user = new User();
            $user->name = 'Admin';
            $user->email = 'admin@nazcastudios.cl';
            $user->password = bcrypt('123456');
            $user->email_verified_at = now();
            $user->save();

        }

        if ( !User::where('email','falvear@nazcastudios.cl')->first() ) {

            $user = new User();
            $user->name = 'Francisco Alvear';
            $user->email = 'falvear@nazcastudios.cl';
            $user->password = bcrypt('jkkxav9q');
            $user->email_verified_at = now();
            $user->save();

        }
    }
}
