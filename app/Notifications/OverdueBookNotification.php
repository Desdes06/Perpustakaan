<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OverdueBookNotification extends Notification
{
    use Queueable;

    protected $bookTitle;
    protected $dueDate;

    /**
     * Create a new notification instance.
     */
    public function __construct($bookTitle, $dueDate)
    {
        $this->bookTitle = $bookTitle;
        $this->dueDate = $dueDate;
    }

    /**
     * Get the notification's delivery channels.
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
            ->subject('Peminjaman Buku Melebihi Batas Waktu')
            ->greeting('Halo, ' . $notifiable->username . '!')
            ->line('Buku "' . $this->bookTitle . '" yang Anda pinjam telah melewati batas pengembalian pada ' . $this->dueDate . '.')
            ->line('Oleh karena itu, sistem telah mengembalikan buku ini secara otomatis.')
            ->line('Terima kasih telah menggunakan layanan perpustakaan kami.');
    }
}