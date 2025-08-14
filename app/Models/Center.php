<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Center  extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        									

        'center_name',
        'center_location',
        'electric_no',
        'woter_no',
        'left_electric_no',
        'created_by',
        'updated_by',
        'img',
        'notes'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'center_location');
    }
     public function units() 
    {
        return $this->hasMany(Unit::class);
    }
}