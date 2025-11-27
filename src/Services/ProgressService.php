<?php

namespace App\Services;

use App\Config\Database;
use PDO;

class ProgressService {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function getComprehensiveStats($userId) {
        $stats = [
            'total_xp' => 0,
            'streak_days' => 0,
            'lessons_completed' => 0,
            'courses_started' => 0,
            'quiz_avg_score' => 0,
            'total_time_minutes' => 0,
            'badges' => [],
            'recent_activity' => [],
            'today_progress' => []
        ];

        // Get basic stats
        $stmt = $this->db->prepare("SELECT total_xp, streak_days FROM users WHERE id = :id");
        $stmt->execute(['id' => $userId]);
        $user = $stmt->fetch();
        if ($user) {
            $stats['total_xp'] = $user['total_xp'] ?? 0;
            $stats['streak_days'] = $user['streak_days'] ?? 0;
        }

        // Lessons completed
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM user_progress WHERE user_id = :id AND completed = 1");
        $stmt->execute(['id' => $userId]);
        $stats['lessons_completed'] = (int)$stmt->fetchColumn();

        // Courses with progress
        $stmt = $this->db->prepare("
            SELECT COUNT(DISTINCT l.course_id) 
            FROM user_progress up 
            JOIN lessons l ON up.lesson_id = l.id 
            WHERE up.user_id = :id
        ");
        $stmt->execute(['id' => $userId]);
        $stats['courses_started'] = (int)$stmt->fetchColumn();

        // Quiz average
        $stmt = $this->db->prepare("SELECT AVG(score) FROM quiz_results WHERE user_id = :id");
        $stmt->execute(['id' => $userId]);
        $stats['quiz_avg_score'] = round($stmt->fetchColumn() ?? 0);

        // Total time
        $stmt = $this->db->prepare("SELECT SUM(time_spent_seconds) FROM user_progress WHERE user_id = :id");
        $stmt->execute(['id' => $userId]);
        $stats['total_time_minutes'] = round(($stmt->fetchColumn() ?? 0) / 60);

        // Badges
        $stmt = $this->db->prepare("SELECT badge_id, badge_name, badge_icon, earned_at FROM user_badges WHERE user_id = :id ORDER BY earned_at DESC");
        $stmt->execute(['id' => $userId]);
        $stats['badges'] = $stmt->fetchAll();

        // Today's progress
        $today = date('Y-m-d');
        $stmt = $this->db->prepare("SELECT * FROM user_activity WHERE user_id = :id AND activity_date = :date");
        $stmt->execute(['id' => $userId, 'date' => $today]);
        $stats['today_progress'] = $stmt->fetch() ?: [
            'lessons_completed' => 0,
            'exercises_completed' => 0,
            'xp_earned' => 0,
            'time_spent_seconds' => 0
        ];

        return $stats;
    }

    public function getCourseProgress($userId, $courseId) {
        $stmt = $this->db->prepare("
            SELECT 
                l.id as lesson_id,
                l.title,
                l.lesson_order,
                COALESCE(up.completed, 0) as completed,
                up.completed_at,
                up.time_spent_seconds
            FROM lessons l
            LEFT JOIN user_progress up ON l.id = up.lesson_id AND up.user_id = :user_id
            WHERE l.course_id = :course_id
            ORDER BY l.lesson_order
        ");
        $stmt->execute(['user_id' => $userId, 'course_id' => $courseId]);
        return $stmt->fetchAll();
    }

    public function recordActivity($userId, $type = 'lesson', $xp = 0, $timeSeconds = 0) {
        $today = date('Y-m-d');
        
        // Check if activity record exists for today
        $stmt = $this->db->prepare("SELECT id FROM user_activity WHERE user_id = :id AND activity_date = :date");
        $stmt->execute(['id' => $userId, 'date' => $today]);
        $exists = $stmt->fetch();

        if ($exists) {
            $field = $type === 'lesson' ? 'lessons_completed' : 'exercises_completed';
            $stmt = $this->db->prepare("
                UPDATE user_activity 
                SET {$field} = {$field} + 1, xp_earned = xp_earned + :xp, time_spent_seconds = time_spent_seconds + :time
                WHERE user_id = :id AND activity_date = :date
            ");
        } else {
            $lessonsCompleted = $type === 'lesson' ? 1 : 0;
            $exercisesCompleted = $type === 'exercise' ? 1 : 0;
            $stmt = $this->db->prepare("
                INSERT INTO user_activity (user_id, activity_date, lessons_completed, exercises_completed, xp_earned, time_spent_seconds)
                VALUES (:id, :date, :lessons, :exercises, :xp, :time)
            ");
            $stmt->bindValue(':lessons', $lessonsCompleted, PDO::PARAM_INT);
            $stmt->bindValue(':exercises', $exercisesCompleted, PDO::PARAM_INT);
        }
        
        $stmt->bindValue(':id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':date', $today);
        $stmt->bindValue(':xp', $xp, PDO::PARAM_INT);
        $stmt->bindValue(':time', $timeSeconds, PDO::PARAM_INT);
        $stmt->execute();

        // Update user XP
        $stmt = $this->db->prepare("UPDATE users SET total_xp = total_xp + :xp WHERE id = :id");
        $stmt->execute(['xp' => $xp, 'id' => $userId]);

        // Update streak
        $this->updateStreak($userId);

        // Check for badges
        $this->checkBadges($userId);
    }

    private function updateStreak($userId) {
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day'));

        $stmt = $this->db->prepare("SELECT last_activity_date, streak_days FROM users WHERE id = :id");
        $stmt->execute(['id' => $userId]);
        $user = $stmt->fetch();

        $lastDate = $user['last_activity_date'] ?? null;
        $streak = $user['streak_days'] ?? 0;

        if ($lastDate === $today) {
            return; // Already logged today
        } elseif ($lastDate === $yesterday) {
            $streak += 1; // Continue streak
        } elseif ($lastDate !== $today) {
            $streak = 1; // Reset streak
        }

        $stmt = $this->db->prepare("UPDATE users SET last_activity_date = :date, streak_days = :streak WHERE id = :id");
        $stmt->execute(['date' => $today, 'streak' => $streak, 'id' => $userId]);
    }

    private function checkBadges($userId) {
        $badges = [
            ['id' => 'first_lesson', 'name' => 'First Steps', 'icon' => '🎯', 'check' => "SELECT COUNT(*) >= 1 FROM user_progress WHERE user_id = :id AND completed = 1"],
            ['id' => 'five_lessons', 'name' => 'Getting Started', 'icon' => '🚀', 'check' => "SELECT COUNT(*) >= 5 FROM user_progress WHERE user_id = :id AND completed = 1"],
            ['id' => 'ten_lessons', 'name' => 'Knowledge Seeker', 'icon' => '📚', 'check' => "SELECT COUNT(*) >= 10 FROM user_progress WHERE user_id = :id AND completed = 1"],
            ['id' => 'streak_3', 'name' => '3-Day Streak', 'icon' => '🔥', 'check' => "SELECT streak_days >= 3 FROM users WHERE id = :id"],
            ['id' => 'streak_7', 'name' => 'Week Warrior', 'icon' => '⚡', 'check' => "SELECT streak_days >= 7 FROM users WHERE id = :id"],
            ['id' => 'quiz_master', 'name' => 'Quiz Master', 'icon' => '🏆', 'check' => "SELECT COUNT(*) >= 3 FROM quiz_results WHERE user_id = :id AND score >= 80"],
            ['id' => 'xp_100', 'name' => 'Century Club', 'icon' => '💯', 'check' => "SELECT total_xp >= 100 FROM users WHERE id = :id"],
            ['id' => 'xp_500', 'name' => 'XP Hunter', 'icon' => '⭐', 'check' => "SELECT total_xp >= 500 FROM users WHERE id = :id"],
        ];

        foreach ($badges as $badge) {
            // Check if already has badge
            $stmt = $this->db->prepare("SELECT id FROM user_badges WHERE user_id = :id AND badge_id = :badge");
            $stmt->execute(['id' => $userId, 'badge' => $badge['id']]);
            if ($stmt->fetch()) continue;

            // Check if earned
            $stmt = $this->db->prepare($badge['check']);
            $stmt->execute(['id' => $userId]);
            $earned = $stmt->fetchColumn();

            if ($earned) {
                $stmt = $this->db->prepare("INSERT INTO user_badges (user_id, badge_id, badge_name, badge_icon) VALUES (:id, :badge, :name, :icon)");
                $stmt->execute(['id' => $userId, 'badge' => $badge['id'], 'name' => $badge['name'], 'icon' => $badge['icon']]);
            }
        }
    }

    public function getWeeklyActivity($userId) {
        $stmt = $this->db->prepare("
            SELECT activity_date, lessons_completed, exercises_completed, xp_earned, time_spent_seconds
            FROM user_activity 
            WHERE user_id = :id AND activity_date >= date('now', '-7 days')
            ORDER BY activity_date ASC
        ");
        $stmt->execute(['id' => $userId]);
        return $stmt->fetchAll();
    }

    public function getLeaderboard($limit = 10) {
        $stmt = $this->db->prepare("
            SELECT u.id, u.name, u.total_xp, u.streak_days,
                   (SELECT COUNT(*) FROM user_progress WHERE user_id = u.id AND completed = 1) as lessons
            FROM users u
            ORDER BY u.total_xp DESC
            LIMIT :limit
        ");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
