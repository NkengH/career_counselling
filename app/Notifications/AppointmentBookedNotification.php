<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Models\Appointment;

class AppointmentBookedNotification extends Notification
{
    use Queueable;

    private $appointment;
    private $studentName;

    /**
     * Create a new notification instance.
     */
    public function __construct(Appointment $appointment, $studentName)
    {
        $this->appointment = $appointment;
        $this->studentName = $studentName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'appointment_id' => $this->appointment->id,
            'student_name' => $this->studentName,
            'appointment_date' => $this->appointment->appointment_date,
            'appointment_time' => $this->appointment->appointment_time,
            'message' => 'Student ' . $this->studentName . ' booked an appointment for ' . $this->appointment->appointment_date . ' at ' . $this->appointment->appointment_time,
        ];
    }
}
