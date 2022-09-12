<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Loan extends Model
{
   //
   protected $table = 'loan';
   protected $fillable = ['amount','term','user_id','status'];

   protected $hidden = [
      'user_id',
  ];
}