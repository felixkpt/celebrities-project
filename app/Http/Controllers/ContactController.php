<?php
namespace App\Http\Controllers;
use App\Notifications\ContactFormMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Models\Recipient;
Class ContactController extends Controller
{
 public function show()
 {
   $data = ['title' => 'Contact us', 'description' => 'Contact us'];
   return view('contact.index', $data);
 }
public function mailContactForm(ContactFormRequest $message, Recipient $recipient)
 {      

    $recipient->notify(new ContactFormMessage($message));
    return redirect()->route('home')->with('success', 'Thanks for your message! We will get back to you soon!');
 }
}