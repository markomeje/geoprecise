<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    /**
     * Permission resource.
     *
     * @var []
     */
    public static $resources = [
        'surveys' => [
            'actions' => [
                'view' => 'View all Survey and Lifting Records', 
                'delete' => 'Delete a survey or lifting record',
                'approve' => 'Approve a survey or lifting record',
            ], 
            'description' => 'All Survey and Lifting Records'
        ],
        'clients' => [
            'actions' => [
                'view' => 'View clients lists and statistics',
            ], 
            'description' => 'All available Clients'
        ],
        'psr' => [
            'actions' => [
                'view' => 'View all Property Search Requests', 
                'delete' => 'Delete a Property Search Request Record.', 
                'update' => 'Edit Property Search Request', 
                'approve' => 'Approve Property Search Request.',
            ], 
            'description' => 'All Property Search Requests'
        ],
        'payments' => [
            'actions' => [
                'view' => 'View all Payment Records',
                'approve' => 'Approve Client Payments.',
            ], 
            'description' => 'All Payment Records',
        ],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 
        'resource', 
        'action',
        'deleted',
        'deleted_at'
    ];

    /**
     * Permission ACTIONS.
     *
     * @var []
     */
    public static $actions = [
        'view',
        'delete',
        'update',
        'create',
        'approve'
    ];

    /**
     * A permission belongs role
     *
     * @var array<string, string>
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}











