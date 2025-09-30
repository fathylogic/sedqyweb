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
        'emp_type',
        'emp_status',
        'join_date',
        'join_dateh',
        'maincenter_id',
        'notes'
    ];

     public function vacations() 
    {
        return $this->hasMany(Vacation::class,'emp_id')->orderBy('id', 'desc');
    }   
    public function payrolls() 
    {
        return $this->hasMany(Payroll::class,'emp_id')->orderBy('id', 'desc');
    }  
    public function empPeriods() 
    {
        return $this->hasMany(Emp_period::class,'emp_id')->orderBy('id', 'desc');
    }
     public function maincenter()
    {
        return $this->belongsTo(Maincenter::class, 'maincenter_id');
    }  
    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id');
    } 
    public function employeeType()
    {
        return $this->belongsTo(Emp_type::class, 'emp_type');
    } 
    public function employeeStatus()
    {
        return $this->belongsTo(Emp_status::class, 'emp_status');
    }

}