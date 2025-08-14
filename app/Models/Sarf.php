<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  use AliAbdalla\Tafqeet\Core\Tafqeet;
class Sarf  extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $table = 'sarfs'; 
    protected $fillable = [
        									
'source_type_id', 'p_date', 'p_dateh', 'amount', 'amount_txt', 'sarf_type_id'
, 'pay_role_id', 'payment_type', 'year_m', 'year_h', 'sereal', 'recipient_id'
, 'from_ohda_id', 'to_ohda_id','s_desc', 'service_type_id', 'center_id', 'unit_id', 'created_at'
, 'updated_at', 'created_by', 'updated_by', 'img','receved_by'


];

public function paymentType()
    {
        return $this->belongsTo(Payment_type::class, 'payment_type');
    }
    public function sourceType()
    {
        return $this->belongsTo(Source_type::class, 'source_type_id');
    } 
    public function sarfType()
    {
        return $this->belongsTo(Sarf_type::class, 'sarf_type_id');
    }
    public function payrool()
    {
        return $this->belongsTo(Payroll::class, 'pay_role_id');
    }
	public function recipient()
    {
        return $this->belongsTo(Recipient::class, 'recipient_id');
    }
    public function fromOhda()
    {
        return $this->belongsTo(Ohda::class, 'from_ohda_id');
    } 
    public function toOhda()
    {
        return $this->belongsTo(Ohda::class, 'to_ohda_id');
    } 
    public function serviceType()
    {
        return $this->belongsTo(Service_type::class, 'service_type_id');
    } 
    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    public function amountText()
    {
       if($this->amount>0)
            return   Tafqeet::arablic($this->amount);
        else return '' ; 
    }
	

   
    
}