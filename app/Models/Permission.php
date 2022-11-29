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
            'description' => 'All Survey and Lifting Application Records'
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
                'update' => 'Edit Property Search Request Application', 
                'approve' => 'Approve Property Search Request Application.',
            ], 
            'description' => 'All Property Search Requests'
        ],
        'payments' => [
            'actions' => [
                'view' => 'View all Payment Records',
                'approve' => 'Approve Payments.',
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
        'user_id', 
        'resource', 
        'description',
        'permission',
        'permitted_by'
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
    ];
}
