<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class EmailTemplateRequestHandler
{
    public function validateSaveRequest(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        return [
            'id' => $request->id,
            'name' => $request->name,
            'subject' => $request->subject,
            'message' => $request->message,
            'type' => $request->type ?? ''
        ];
    }
}
