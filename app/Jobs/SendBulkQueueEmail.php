<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendBulkQueueEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $recipeints = $this->data->recipients;
        $input['subject'] = $this->data->subject;
        $template_data = ['email_template' => $this->data->email_template];

        foreach ($recipeints as $recipeint) {
            $input['recipeint'] = $recipeint;
            Mail::send('emails.messages.mails', $template_data, function ($message) use ($input) {
                $message->to($input['recipeint'])
                    ->from('oshka@laravel-dev-small-task.com', 'oshka')
                    ->subject($input['subject']);
            });
        }
    }
}
