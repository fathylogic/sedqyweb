<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Unit_type  extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        									

        'name',
        'description'
    ];

   
    //  public function units() 
    // {
    //     return $this->hasMany(Unit::class);
    // }
}