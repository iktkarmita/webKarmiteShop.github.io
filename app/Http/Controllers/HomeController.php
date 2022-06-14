<?php

namespace App\Http\Controllers;

use App\Models\Produks;
use Illuminate\Http\Request;
use App\Repositories\ProduksRepository;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $ProduksRepository;
    public function __construct(ProduksRepository $ProduksRepository)
    {
        $this->middleware('auth');
        $this->ProduksRepository = $ProduksRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $Produk = produks::all();

        return view('home', compact(['Produk']));
    }
    public function cartt($id)
    {
        $this->middleware('auth');
        $Produk = $this->ProduksRepository->findById($id);
        return view('cart', compact(['Produk']));
    }
}
