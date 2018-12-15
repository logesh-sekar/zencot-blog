<?php

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Role;
use App\User;

use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // Roles
        $role_editor = Role::firstOrCreate(['name' => Role::ROLE_EDITOR]);
        $role_admin = Role::firstOrCreate(['name' => Role::ROLE_ADMIN]);

        // Users
        $user = User::firstOrCreate(
            ['email' => 'test@test.com'],
            [
                'name' => 'John Miller',
                'password' => Hash::make('Test123'),
                'registered_at' => now(),
                'email_verified_at' => now()
            ]
        );

        $user->roles()->sync([$role_admin->id]);

        $user = User::firstOrCreate(
            ['email' => 'ben@test.com'],
            [
                'name' => 'Ben Will',
                'password' => Hash::make('Test123'),
                'registered_at' => now(),
                'email_verified_at' => now()
            ]
        );
        $user->roles()->sync([$role_editor->id]);


        // Posts
        $post = Post::firstOrCreate(
            [
                'title' => 'Sample First Blog',
                'author_id' => $user->id
            ],
            [
                'slug'=> 'test blog',
                'posted_at' => now(),
                'content' => "
                <strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. <br>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<br><br>
                 It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. <br>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
            ]
        );

        // Comments
        Comment::firstOrCreate(
            [
                'author_id' => $user->id,
                'post_id' => $post->id
            ],
            [
                'posted_at' => now(),
                'comment' => "Sample Comments by the test user."
            ]
        );
    }
}
