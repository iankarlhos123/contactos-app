<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $contacts = $request->user()
            ->contacts()
            ->latest()
            ->paginate(5);

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'phone_number' => ['required', 'string', 'max:14'],
        ], [
            'name.required' => 'El nombre es obligatorio esto no es cuento del profe Luisk.',
            'name.string' => 'El nombre debe ser texto.',
            'name.max' => 'El nombre no puede tener más de 50 caracteres.',
            'phone_number.required' => 'El número de teléfono es obligatorio.',
            'phone_number.string' => 'El número de teléfono debe ser texto.',
            'phone_number.max' => 'El número de teléfono no puede tener más de 14 caracteres.',
        ]);

        $request->user()->contacts()->create($validated);

        return redirect()
            ->route('contacts.index')
        ->with('status', 'Contacto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Contact $contact)
    {
        $this->authorizeContact($request, $contact);

        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Contact $contact)
    {
       $this->authorizeContact($request, $contact);

       return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
      $this->authorizeContact($request, $contact);

      $validated = $request->validate([
        'name' => ['required', 'string', 'max:50'],
        'phone_number' => ['required', 'string', 'max:14'],
      ]);

      $contact->update($validated);

      return redirect()
        ->route('contacts.index')
        ->with('status', 'Contacto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Contact $contact)
    {
       $this->authorizeContact($request, $contact);

       $contact->delete();

       return redirect()
          ->route('contacts.index')
          ->with('status', 'Contacto eliminado correctamente.');
    }

    private function authorizeContact(Request $request, Contact $contact): void 
    {
        abort_unless($contact->user_id === $request->user()->id, 403);
    }


}
