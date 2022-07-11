<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Recipient extends Model
{
  use Notifiable;
  protected $recipient;
  protected $email;
  public function __construct() {
        $this->recipient = config('recipient.name');
        $this->email = config('recipient.email');
    }
}