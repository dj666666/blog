<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;
    //修改为自己的用户表
    protected $table = 'users';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    //添加对blog表的关联 一对多
    public function blogs(){
        return $this->hasMany(Blog::class,'user_id');
    }

    //获取所有粉丝
    //添加对follows表的关联 多对多
    //这里是通过userid去follows表中找关注者，也就是这个userid的粉丝 主角是userid
    public function follower(){
        return $this->belongsToMany(User::class,'follows','user_id','follower');
    }
    //获取所有关注
    //这里是通过follower去follows表中找被关注者，也就是这个follower所关注的人 主角是follower
    public function following(){
        return $this->belongsToMany(User::class,'follows','follower','user_id');
    }


    //检测是否关注这个$uid
    /*
     * 指定用户是否是谁的粉丝
     */
    public function isFollow($uid){
        return $this->follower()->WherePivot('follower',$uid)->first();
    }

    //关注或取关
    public function followToggle($ids){
        $ids = is_array($ids) ? : [$ids];
        return $this->follower()->withTimestamps()->toggle($ids);
    }
}
