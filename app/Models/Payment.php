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
        									
'contract_id', 'maincenter_id','center_id','unit_id','is_for_sale_product','product_desc','p_date', 'p_dateh', 'amount','amount_txt', 'payment_no', 'emp_id', 'payment_type', 'status', 'year_m', 'year_h', 'sereal', 'actual_date', 'actual_dateh', 'notes', 'created_at', 'updated_at', 'created_by', 'updated_by', 'img'  

];

public function paymentType()
    {
        return $this->belongsTo(Payment_type::class, 'payment_type');
    }
	public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
    public function maincenter()
    {
        return $this->belongsTo(Maincenter::class, 'maincenter_id');
    } 
    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id');
    } 
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
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