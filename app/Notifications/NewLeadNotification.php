<?php

namespace App\Notifications;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLeadNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Lead $lead) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("🔔 Lead Baru Website: {$this->lead->name}")
            ->greeting('Halo Admin Swift Code!')
            ->line('Ada calon klien baru yang mengirimkan formulir konsultasi website melalui website resmi.')
            ->line("**Nama:** {$this->lead->name}")
            ->line("**WhatsApp:** {$this->lead->phone}")
            ->line('**Email:** '.($this->lead->email ?: '-'))
            ->line("**Layanan:** {$this->lead->service_type}")
            ->line('**Estimasi Budget:** '.($this->lead->budget ?: '-'))
            ->line('**Pesan:**')
            ->line($this->lead->message)
            ->action('Buka Panel Admin', url('/admin/leads'))
            ->line('Silakan segera tindak lanjuti lead ini agar peluang closing semakin tinggi.');
    }
}
