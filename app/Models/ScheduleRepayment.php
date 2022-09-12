<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ScheduleRepayment extends Model
{
   //
   protected $table = 'schedule_repayment';
   protected $fillable = ['amount','date','status','loan_id'];

   protected $hidden = [
      'loan_id',
  ];
}