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
        'surveys' => ['actions' => ['view' => 'View all Survey and Lifting Records', 'delete' => 'Delete a survey or lifting record'], 'description' => 'All Survey and Lifting Application Records'],
        'clients' => ['actions' => ['delete' => 'Delete any registered user', 'view' => 'View clients lists and statistics'], 'description' => 'All clients list and statistics'],
        'units' => ['actions' => ['create' => 'Create a unit to be sold', 'view' => 'View list of all units and statistics', 'update' => 'Update created units', 'delete' => 'Delete any unit.'], 'description' => 'All units created and purchases'],
        'properties' => ['actions' => ['view' => 'View all listed properties', 'delete' => 'Delete any listed property'], 'description' => 'All properties listed', 'update' => 'Update property details.'],
        'blogs' => ['actions' => ['create' => 'Create a blog post', 'view' => 'View all blog posts and statistics', 'update' => 'Update a blog post record', 'delete' => 'Delete a blog post'], 'description' => 'All blog posts and statistics'],

        'psr' => ['actions' => ['view' => 'View all Property Search Requests', 'delete' => 'Delete a Property Search Request Record.', 'update' => 'Edit Property Search Request Application', 'approve' => 'Approve Property Search Request Application.'], 'description' => 'All Property Search Requests'],

        'news' => ['actions' => ['create' => 'Create daily news', 'view' => 'View all news', 'update' => 'Update any news', 'delete' => 'Delete any news.'], 'description' => 'All news posted and statistics'],
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
