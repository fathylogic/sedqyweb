<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Ohdas_operation  extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        									

        'ohda_id',
        'op_type',
        'sarf_id',
        'amount',
        'created_at',
        'last_amount',
        'updated_at' 
    ];

     public function ohda()
    {
        return $this->belongsTo(Ohda::class, 'ohda_id');
    } 
      public function sarf()
    {
        return $this->belongsTo(Sarf::class, 'sarf_id');
    } 
     public function opType() 
    {
         if( $this->op_type=='+')
            return 'ايداع' ; 
        else return 'سحب' ; 
    }
     
}