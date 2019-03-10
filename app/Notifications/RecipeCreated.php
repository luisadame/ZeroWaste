<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Recipe;

class RecipeCreated extends Notification implements ShouldQueue
{
    use Queueable;

    private $recipe;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Recipe $recipe)
    {
        $this->recipe = $recipe;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = route('recipes.show', $this->recipe);
        return (new MailMessage)
                    ->greeting('Hello!')
                    ->line('You\'ve created a new recipe!')
                    ->action('View recipe', $url)
                    ->line('When will you create your next recipe?');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'recipe_id' => $this->recipe->id,
            'message' => $this->recipe->name . ' has been created!'
        ];
    }
}
