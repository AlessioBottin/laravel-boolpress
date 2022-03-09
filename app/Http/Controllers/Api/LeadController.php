<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lead;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContactMail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request) {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'content' => 'required|max:60000',
        ]);

        if ($validator->fails()) {
            // Ritorna gli errori di validazione
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        // Salvo la nuova lead nel db 
        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        // invio la mail a chi di competenza
        Mail::to('customerservice@boolpress.it')->send(new NewContactMail($new_lead));

        return response()->json([
            'success' => true,
        ]);


    }
}
