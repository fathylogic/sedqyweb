<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Maincenter  extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        									

        'name',
        'iban',
        'emp_id',
        'created_by',
        'updated_by',
        'img',
        'notes'
    ];

    
     public function centers() 
    {
        return $this->hasMany(Center::class);
    }
     public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }
}