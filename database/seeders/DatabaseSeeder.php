<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts=new Collection();
        $users=User::factory()->count(10)->create();

        foreach($users as $user){
            $posts=$posts->merge(Post::factory(['user_id'=>$user->id])->count(2)->create());
        }
        $user_ids=$users->pluck('id')->toArray();
        //pluck estrae come array una colonna della connection
        foreach($posts as $post){
            
            Comment::factory(['post_id'=>$post->id,'user_id'=>$user_ids[array_rand($user_ids)]])->count(5)->create();
        }
    }
}
