<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class ActivityService
{
    /**
     * Log an activity
     *
     * @param string $description The activity description
     * @param string $type The type of activity (product, category, order, etc.)
     * @param string $action The action performed (create, update, delete)
     * @param mixed $subject The subject model instance
     * @param string|null $icon Custom icon class (optional)
     * @return Activity|null
     */
    public static function log($description, $type, $action, $subject = null, $icon = null)
    {
        // Check if activities table exists
        if (!Schema::hasTable('activities')) {
            // Log to Laravel log instead
            Log::info("Activity: {$description} [{$type}:{$action}]");
            return null;
        }
        
        $data = [
            'description' => $description,
            'type' => $type,
            'action' => $action,
            'user_id' => Auth::id(),
            'icon' => $icon
        ];

        if ($subject) {
            $data['subject_id'] = $subject->id;
            $data['subject_type'] = get_class($subject);
        }

        try {
            return Activity::create($data);
        } catch (\Exception $e) {
            // Fallback to Laravel log
            Log::info("Activity: {$description} [{$type}:{$action}]");
            return null;
        }
    }

    /**
     * Get recent activities
     *
     * @param int $limit Number of activities to retrieve
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getRecent($limit = 10)
    {
        // Check if activities table exists
        if (!Schema::hasTable('activities')) {
            return collect([]);
        }
        
        try {
            return Activity::latest()->limit($limit)->get();
        } catch (\Exception $e) {
            return collect([]);
        }
    }
}