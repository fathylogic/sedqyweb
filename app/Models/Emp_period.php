<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Emp_period  extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
     protected $table = 'emp_periods';
       protected $fillable = [
        									
             'start_date', 'end_date', 'start_dateh', 'end_dateh', 'no_of_days', 'emp_id', 'notes', 'created_at', 'updated_at', 'created_by', 'updated_by'
      ];

   
    public function employee() 
    {
        
        return $this->belongsTo(Employee::class, 'emp_id');
    } 
    
    
}