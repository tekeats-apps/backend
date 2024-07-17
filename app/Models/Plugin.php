<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

class Plugin extends Model
{
    use HasFactory, HasUuids, CentralConnection;

    public const IMAGE_PATH = 'plugins';
    public const DOCUMENTATION_PATH = 'plugins/documents';
    public const DEFAULT_IMAGE_PATH = 'https://solidwp.com/wp-content/uploads/2017/05/what-is-a-plugin.png';

    protected $fillable = [
        'id',
        'uuid',
        'plugin_type_id',
        'name',
        'image',
        'documentation',
        'video',
        'description',
        'version',
        'is_paid',
        'price',
        'active',
        'featured',
        'settings_form'
    ];

    protected $casts = [
        'is_paid' => 'boolean',
        'active' => 'boolean',
        'featured' => 'boolean',
        'created_at' => 'datetime:M d, Y H:i',
        'updated_at' => 'datetime:M d, Y H:i',
        'settings_form' => 'array',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (request()->capture()->is('platform/*')) {
            $this->hidden = array_merge($this->hidden, ['id', 'plugin_type_id']);
        }
    }

    public function uniqueIds()
    {
        return ['uuid'];
    }

    protected function getImageAttribute($value)
    {
        $image = Plugin::DEFAULT_IMAGE_PATH;
        if ($value) {
            $path = Plugin::IMAGE_PATH . '/' . $value;
            $image = Storage::disk('s3-central')->url($path);
        }

        return $image;
    }

    protected function getDocumentationAttribute($value)
    {
        $documentation = null;
        if ($value) {
            $path = Plugin::DOCUMENTATION_PATH . '/' . $value;
            $documentation = Storage::disk('s3-central')->url($path);
        }

        return $documentation;
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(PluginType::class, 'plugin_type_id');
    }
}
