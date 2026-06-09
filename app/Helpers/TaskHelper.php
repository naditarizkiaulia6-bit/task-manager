<?php

namespace App\Helpers;

class TaskHelper
{
    /**
     * Get color class for category
     */
    public static function getCategoryColor(string $category): string
    {
        return match($category) {
            'design' => 'purple',
            'dev' => 'blue',
            'bug' => 'red',
            'research' => 'green',
            default => 'gray',
        };
    }

    /**
     * Get Tailwind color class for category
     */
    public static function getCategoryColorClass(string $category): string
    {
        return match($category) {
            'design' => 'bg-purple-500 text-white',
            'dev' => 'bg-blue-500 text-white',
            'bug' => 'bg-red-500 text-white',
            'research' => 'bg-green-500 text-white',
            default => 'bg-gray-500 text-white',
        };
    }

    /**
     * Get color class for priority
     */
    public static function getPriorityColor(string $priority): string
    {
        return match($priority) {
            'high' => 'red',
            'medium' => 'yellow',
            'low' => 'green',
            default => 'gray',
        };
    }

    /**
     * Get Tailwind color class for priority
     */
    public static function getPriorityColorClass(string $priority): string
    {
        return match($priority) {
            'high' => 'bg-red-100 text-red-700',
            'medium' => 'bg-yellow-100 text-yellow-700',
            'low' => 'bg-green-100 text-green-700',
            default => 'bg-gray-100 text-gray-700',
        };
    }

    /**
     * Get status label in Indonesian
     */
    public static function getStatusLabel(string $status): string
    {
        return match($status) {
            'todo' => 'Belum Mulai',
            'progress' => 'Sedang Dikerjakan',
            'review' => 'Review',
            'done' => 'Selesai',
            default => 'Unknown',
        };
    }

    /**
     * Get category label in Indonesian
     */
    public static function getCategoryLabel(string $category): string
    {
        return match($category) {
            'design' => 'Desain',
            'dev' => 'Pengembangan',
            'bug' => 'Bug',
            'research' => 'Riset',
            default => 'Unknown',
        };
    }

    /**
     * Get priority label in Indonesian
     */
    public static function getPriorityLabel(string $priority): string
    {
        return match($priority) {
            'high' => 'Tinggi',
            'medium' => 'Sedang',
            'low' => 'Rendah',
            default => 'Unknown',
        };
    }

    /**
     * Get status progress color
     */
    public static function getStatusProgressColor(string $status): string
    {
        return match($status) {
            'todo' => 'gray',
            'progress' => 'blue',
            'review' => 'yellow',
            'done' => 'green',
            default => 'gray',
        };
    }

    /**
     * Get next status in workflow
     */
    public static function getNextStatus(string $currentStatus): ?string
    {
        return match($currentStatus) {
            'todo' => 'progress',
            'progress' => 'review',
            'review' => 'done',
            'done' => null,
            default => null,
        };
    }

    /**
     * Check if status is in workflow
     */
    public static function isValidStatus(string $status): bool
    {
        return in_array($status, ['todo', 'progress', 'review', 'done']);
    }

    /**
     * Check if category is valid
     */
    public static function isValidCategory(string $category): bool
    {
        return in_array($category, ['design', 'dev', 'bug', 'research']);
    }

    /**
     * Check if priority is valid
     */
    public static function isValidPriority(string $priority): bool
    {
        return in_array($priority, ['low', 'medium', 'high']);
    }

    /**
     * Get all available statuses
     */
    public static function getAllStatuses(): array
    {
        return ['todo', 'progress', 'review', 'done'];
    }

    /**
     * Get all available categories
     */
    public static function getAllCategories(): array
    {
        return ['design', 'dev', 'bug', 'research'];
    }

    /**
     * Get all available priorities
     */
    public static function getAllPriorities(): array
    {
        return ['low', 'medium', 'high'];
    }

    /**
     * Format progress percentage
     */
    public static function formatProgress(int $progress): string
    {
        return $progress . '%';
    }

    /**
     * Get avatar initials from name
     */
    public static function getInitials(string $name): string
    {
        $parts = explode(' ', trim($name));
        $initials = '';

        foreach ($parts as $part) {
            if (!empty($part)) {
                $initials .= strtoupper($part[0]);
            }
        }

        return substr($initials, 0, 2);
    }

    /**
     * Get avatar color based on name
     */
    public static function getAvatarColor(string $name): string
    {
        $colors = ['indigo', 'blue', 'purple', 'red', 'green', 'yellow', 'pink', 'orange'];
        $hash = crc32($name);
        $index = abs($hash) % count($colors);

        return $colors[$index];
    }
}
