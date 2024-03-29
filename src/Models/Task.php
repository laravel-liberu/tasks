<?php

namespace LaravelLiberu\Tasks\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Auth;
use LaravelLiberu\Tables\Traits\TableCache;
use LaravelLiberu\Tasks\Notifications\TaskNotification;
use LaravelLiberu\TrackWho\Traits\CreatedBy;
use LaravelLiberu\TrackWho\Traits\UpdatedBy;
use LaravelLiberu\Users\Models\User;

class Task extends Model
{
    use TableCache;
    use HasFactory;
    use CreatedBy;
    use UpdatedBy;

    protected $guarded = ['id'];

    protected $dates = ['reminder', 'reminded_at'];

    protected $casts = ['completed' => 'boolean'];

    public function allocatedTo(): Relation
    {
        return $this->belongsTo(User::class, 'allocated_to');
    }

    public function scopeNotReminded($query)
    {
        return $query->whereNull('reminded_at');
    }

    public function scopeOverdue($query)
    {
        return $query->pending()
            ->where('reminder', '<=', Carbon::now());
    }

    public function scopeVisible($query)
    {
        $user = Auth::user();
        $superiorUser = $user->isAdmin() || $user->isSupervisor();

        return $query->when(!$superiorUser, fn ($query) => $query
            ->where(fn ($query) => $query->whereCreatedBy($user->id)
                ->orWhere('allocated_to', $user->id)));
    }

    public function scopePending($query)
    {
        return $query->whereCompleted(false);
    }

    public function scopeCompleted($query)
    {
        return $query->whereCompleted(true);
    }

    public function setReminderAttribute($dateTime)
    {
        if (Carbon::now()->lessThan($dateTime)) {
            $this->reminded_at = null;
        }

        $this->attributes['reminder'] = $dateTime;
    }

    public function remind()
    {
        $this->allocatedTo->notify((new TaskNotification($this))
            ->onQueue('notifications'));

        $this->update(['reminded_at' => Carbon::now()]);
    }

    public function overdue(): bool
    {
        return !$this->completed
            && $this->reminder?->lessThan(Carbon::now());
    }
}
