<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*\App\User::create([
            'name'=>'lisi',
            'email'=>'lisi@qq.com',
            'password'=>bcrypt('123456'),
        ]);*/
        //以上代码是生成一条数据，接下来用模型工厂快捷生成多条数据
        factory(App\User::class,100)->create();
        $user = App\User::find('1');
        $user->name ='丁杰1';
        $user->email ='2224346215@qq.com';
        $user->password = bcrypt('123456');
        $user->is_admin =true;
        $user->save();

        $user = App\User::find('2');
        $user->name ='丁杰2';
        $user->email ='2224346216@qq.com';
        $user->password = bcrypt('123456');
        $user->save();


    }
}
