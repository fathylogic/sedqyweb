<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Employee  extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'name',
        'id_no',
        'nationality',
        'mobile_no',
        'iban',
        'job',
        'center_id',
        'salary',
        'birthday',
        'birthdayh',
        'created_by',
        'updated_by',
        'img',
        'notes'
    ];

     public function vacations() 
    {
        return $this->hasMany(Vacation::class,'emp_id');
    }

}