<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Unit  extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        									

        'unit_type',
        'unit_description',
        'center_id',
        'woter_no',
        'electric_no',
        'current_renter_id',
        'floor_no',
        'unit_no',
        'created_by',
        'updated_by',
        'img',
        'notes'
    ];

    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id');
    } 
    public function unitType()
    {
        return $this->belongsTo(Unit_type::class, 'unit_type');
    }
    public function renter()
    {
        return $this->belongsTo(Renter::class, 'current_renter_id');
    }
   
    public function contracts() 
    {
        return $this->hasMany(Contract::class);
    }
   
}