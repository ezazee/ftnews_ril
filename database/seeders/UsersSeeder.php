<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Abdee',
            'last_name' => 'Putra',
            'name' => 'abdee',
            'slug' => Str::slug('abdee'),
            'email' => 'backend@indopop.id',
            'phone' => '',
            'birthday' => NULL,
            'description' => '',
            'password' => bcrypt('g[b?%-6N'),
            'email_verified_at' => now(),
            'status' => 'active',
            'role_id' => 2,
            'images' => ''
        ]);

        User::create([
            'first_name' => 'Chae',
            'last_name' => '',
            'name' => 'Chae',
            'slug' => Str::slug('Chae'),
            'email' => 'mamahkuki97@gmail.com',
            'phone' => '',
            'birthday' => NULL,
            'description' => '',
            'password' => bcrypt('XQ4{rkk@'),
            'email_verified_at' => now(),
            'status' => 'active',
            'role_id' => 1,
            'images' => ''
        ]);

        User::create([
            'first_name' => 'Deka',
            'last_name' => '',
            'name' => 'Deka',
            'slug' => Str::slug('Deka'),
            'email' => 'dekade1091@gmail.com',
            'phone' => '',
            'birthday' => NULL,
            'description' => '',
            'password' => bcrypt('8z6vc@F!'),
            'email_verified_at' => now(),
            'status' => 'active',
            'role_id' => 1,
            'images' => ''
        ]);

        User::create([
            'first_name' => 'indopop',
            'last_name' => '',
            'name' => 'indopop',
            'slug' => Str::slug('indopop'),
            'email' => 'indopop@gmail.com',
            'phone' => '',
            'birthday' => NULL,
            'description' => '',
            'password' => bcrypt('AhW8X?$-'),
            'email_verified_at' => now(),
            'status' => 'active',
            'role_id' => 2,
            'images' => ''
        ]);

        User::create([
            'first_name' => 'Madinah',
            'last_name' => 'Roesly',
            'name' => 'Madmad',
            'slug' => Str::slug('Madmad'),
            'email' => 'djalumeysha123@gmail.com',
            'phone' => '',
            'birthday' => NULL,
            'description' => '',
            'password' => bcrypt('2$fR8uGp'),
            'email_verified_at' => now(),
            'status' => 'active',
            'role_id' => 2,
            'images' => ''
        ]);
        
        User::create([
            'first_name' => 'Pijar',
            'last_name' => '',
            'name' => 'Pijar',
            'slug' => Str::slug('Pijar'),
            'email' => 'zeerblast@gmail.com',
            'phone' => '',
            'birthday' => NULL,
            'description' => '',
            'password' => bcrypt('2f^(2f$H'),
            'email_verified_at' => now(),
            'status' => 'active',
            'role_id' => 1,
            'images' => ''
        ]);

        User::create([
            'first_name' => 'Pungki',
            'last_name' => '',
            'name' => 'Pungki',
            'slug' => Str::slug('Pungki'),
            'email' => 'pungkisyahreza@gmail.com',
            'phone' => '',
            'birthday' => NULL,
            'description' => '',
            'password' => bcrypt('4J.N.Lpa'),
            'email_verified_at' => now(),
            'status' => 'active',
            'role_id' => 1,
            'images' => ''
        ]);

        User::create([
            'first_name' => 'Roso',
            'last_name' => 'Daras',
            'name' => 'rosodaras',
            'slug' => Str::slug('rosodaras'),
            'email' => 'rosodaras@gmail.com',
            'phone' => '',
            'birthday' => NULL,
            'description' => '',
            'password' => bcrypt('-HFLE9mC'),
            'email_verified_at' => now(),
            'status' => 'active',
            'role_id' => 1,
            'images' => ''
        ]);

        User::create([
            'first_name' => 'Tomi',
            'last_name' => 'Tresnady',
            'name' => 'tomitresnady',
            'slug' => Str::slug('tomitresnady'),
            'email' => 'tomi.tresnady@gmail.com',
            'phone' => '',
            'birthday' => NULL,
            'description' => '',
            'password' => bcrypt(']8a7+C6!'),
            'email_verified_at' => now(),
            'status' => 'active',
            'role_id' => 1,
            'images' => ''
        ]);

        User::create([
            'first_name' => 'Wardha',
            'last_name' => '',
            'name' => 'Wardha',
            'slug' => Str::slug('Wardha'),
            'email' => 'wardhajannah.020708@gmail.com',
            'phone' => '',
            'birthday' => NULL,
            'description' => '',
            'password' => bcrypt('$$S6K&5y'),
            'email_verified_at' => now(),
            'status' => 'active',
            'role_id' => 1,
            'images' => ''
        ]);
    }
}
