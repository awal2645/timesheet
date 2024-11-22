<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['employer_id', 'client_id', 'project_id', 'invoice_number', 'invoice_date', 'total_cost', 'status'];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }       
    public function items() // Assuming items are tasks
    {
        return $this->hasMany(Task::class); // Adjust this if your relationship is different
    }
}
