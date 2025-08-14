<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Contract  extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        									
           'start_date', 'end_date', 'start_dateh', 'end_dateh', 'no_of_payments', 'year_amount','services_amount', 'insurance_amount', 'unit_id', 'center_id', 'renter_id', 'notes', 'created_at', 'updated_at', 'created_by', 'updated_by', 'img', 'is_active'
    ];

   public function payments() 
    {
        return $this->hasMany(Payment::class);
    } 
    public function renter() 
    {
        
        return $this->belongsTo(Renter::class, 'renter_id');
    } 
    public function unit() 
    {
        
        return $this->belongsTo(Unit::class, 'unit_id');
    } 
    public function center() 
    {
        
        return $this->belongsTo(Center::class, 'center_id');
    }
    
}