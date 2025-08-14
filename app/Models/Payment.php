<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  use AliAbdalla\Tafqeet\Core\Tafqeet;
class Payment  extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        									
'contract_id', 'p_date', 'p_dateh', 'amount','amount_txt', 'payment_no', 'emp_id', 'payment_type', 'status', 'year_m', 'year_h', 'sereal', 'actual_date', 'actual_dateh', 'notes', 'created_at', 'updated_at', 'created_by', 'updated_by', 'img'  

];

public function paymentType()
    {
        return $this->belongsTo(Payment_type::class, 'payment_type');
    }
	public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }
    public function amountText()
    {
       if($this->amount>0)
            return   Tafqeet::arablic($this->amount);
        else return '' ; 
    }
	

   
    
}