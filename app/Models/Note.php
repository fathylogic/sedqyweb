<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Note  extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'user_id',
        'message',
        'is_to_admin',
        'created_at',
        'updated_at',
        'title'
    ];

    public function files() 
    {
        return $this->hasMany(Notes_file::class);
    }

}