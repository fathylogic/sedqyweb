<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Recipient  extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'name',
        'r_type',
        'r_address',
        'iban',
        'mobile_no',
        'created_by',
        'updated_by',
        'id_no',
        'id_type',
        'nationality',
        'other_no',
        'img',
        'notes'
    ];

       
public function idType()
    {
        return $this->belongsTo(Id_type::class, 'id_type');
    }

}