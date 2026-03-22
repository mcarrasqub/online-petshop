<?php
 
//edited by Sofia Gallo

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(): View
    {
        return view('payment.index');
    }

    public function save(StorePaymentRequest $request): RedirectResponse
    {
        Payment::create($request->validated());

        return back()->with('success', 'Pago procesado exitosamente');

    }

    public function list(): View
    {
        $viewData = [];
        $viewData["title"] = "Pagos - Tienda de mascotas";
        $viewData["subtitle"] =  "Lista de pagos";
        $viewData["payments"] = Payment::all();

        return view('payment.list')->with("viewData", $viewData);
    }

    public function show(string $id) : View
    {
        $viewData = [];
        $payment = Payment::findOrFail($id);
        $viewData["title"] = $payment["amount"]." - Tienda de mascotas";
        $viewData["subtitle"] =  $payment["amount"]." - Información del pago";
        $viewData["payment"] = $payment;

        return view('payment.show')->with("viewData", $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData["title"] = "Crear Pago - Tienda de mascotas";
        $viewData["subtitle"] = "Crea un pago nuevo";

        return view('payment.create')->with("viewData", $viewData);
    }

    public function destroy(string $id): RedirectResponse
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        
        return redirect()->route("payment.list");
    }       
}
