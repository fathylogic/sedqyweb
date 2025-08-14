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
        'img',
        'notes'
    ];

}