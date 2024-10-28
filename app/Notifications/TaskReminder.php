<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskReminder extends Notification
{
    use Queueable;

    public $project;

    public function __construct($project)
    {
        $this->project = $project;
    }

    public function via($notifiable)
    {
        return ['mail']; // Anda bisa menambahkan channel lain jika diperlukan
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Pengingat Tugas untuk Proyek: ' . $this->project->name)
            ->line('Proyek "' . $this->project->name . '" mendekati tenggat waktu.')
            ->line('Silakan periksa tugas yang perlu diselesaikan.')
            ->action('Lihat Proyek', url('/projects/' . $this->project->id));
    }
}
