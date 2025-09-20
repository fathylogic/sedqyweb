<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Ohda  extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        									

        'emp_id',
        'purpose',
        'raseed',
        'center_id',
        'maincenter_id',
         
        'created_at',
        'updated_at' 
    ];

     public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    } 
     public function operatios() 
    {
        return $this->hasMany(Ohdas_operation::class);
    }
     
}