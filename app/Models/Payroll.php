<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  use AliAbdalla\Tafqeet\Core\Tafqeet;
class Payroll  extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        									
'emp_id','salary_year_month','basic_salary','other_allowance','deductions','other_allowance_purpose', 'deductions_purpose','p_date', 'p_dateh', 'net_salary','net_salary_txt', 'payment_status',  'payment_type',  'created_at', 'updated_at', 'created_by', 'updated_by'  

];

public function paymentType()
    {
        return $this->belongsTo(Payment_type::class, 'payment_type');
    }
	 
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    } 
   public function sarf() 
    {
        return $this->hasOne(Sarf::class,'pay_role_id');
    }
    public function net_salaryText()
    {
       if($this->net_salary>0)
            return   Tafqeet::arablic($this->net_salary);
        else return '' ; 
    }
	

   
    
}