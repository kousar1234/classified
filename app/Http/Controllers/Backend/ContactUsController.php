<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactUsMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactUsController extends Controller
{
    /**
     * Will return message list
     */
    public function messages(): View
    {
        $messages = ContactUsMessage::paginate(10)->withQueryString();

        return view('backend.modules.messages.messages', ['messages' => $messages]);
    }

    /**
     * Will delete a message
     */
    public function deleteMessage(Request $request): RedirectResponse
    {
        try {
            $message = ContactUsMessage::findOrFail($request['id']);
            $message->delete();
            toastNotification('Success', 'Message deleted successfully', 'Success');
            return to_route('admin.contact.us.message.list');
        } catch (\Exception $e) {
            toastNotification('error', 'Message delete failed', 'Error');
            return redirect()->back();
        }
    }
}
