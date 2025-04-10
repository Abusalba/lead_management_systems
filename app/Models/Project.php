<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model 
{
    use HasFactory;
    
    protected $fillable = [
        'project_name',
        'description',
        'start_date',
        'end_date',
        'assigned_team_id',
        'status',
        'linked_lead_id',
    ];
    
    /**
     * Get the lead associated with this project
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class, 'linked_lead_id', 'lead_id');
    }
}