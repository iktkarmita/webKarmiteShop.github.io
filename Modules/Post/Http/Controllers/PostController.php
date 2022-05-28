<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\ProdukController;
use Modules\Post\Models\Produks;
use Modules\Post\Repositories\PostRepository;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
    
     * @return void
     */
    private $ProduksRepository;
    public function __construct(PostRepository $PostRepository)
    {
        $this->middleware('auth');
        $this->PostRepository = $PostRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $role = Auth::user()->role;

        if ($role == '1') {
            return view('post::index');
        } else {
            return redirect('/home');
        }
    }


    /** 
     * Show the form for creating a new resource.
     * @return Renderable 
     */
    public function create()
    {
        return view('post::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:344',
            'keterangan' => 'required',
            'harga' => 'required',
            'persediaan' => 'required',
            'image' => 'image|file|min:5'
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }
        //
        //dd($request->except(['_token', 'submit']));
        Produks::create($validatedData);
        session()->flash('success', 'Produks has been added !!');
        return redirect('/post');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('post::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('post::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
