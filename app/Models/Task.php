<?php
// 私はここにいるクラスです
namespace App\Models;
// 私はこのクラスを使います
use resources\view\tasks\index;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
      /**
     * タスク所有ユーザーの取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
