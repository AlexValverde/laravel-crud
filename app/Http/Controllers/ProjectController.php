<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('projects.index', ['projects' => Project::All()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project();
        return view('projects.create', ['project' => $project]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $values = $request->all();
        $values['content'] = $this->encrypt($values['content'], $request->get('secret'));
        $user = Auth::user();
        $values['user_id'] = $user->id;
        $project = Project::create($values);
        return redirect()->route('projects.edit', ['id' => $project->id])->with('secret',$request->get('secret'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        return view('projects.show', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $secret = $request->has('secret') ? $request->get('secret'): session('secret');
        $project->content = $this->decrypt($project->content, $secret);
        $project->secret = $secret;
        return view('projects.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $values = $request->all();
        $values['content'] = $this->encrypt($values['content'], $request->get('secret'));
        $project->fill($values);
        $project->save();
        return view('projects.edit', ['project' => $project]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return view('projects.index', ['projects' => Project::All()]);
    }

    public function enterPassword(Request $request) {
        return redirect()->route('projects.edit', ['id' => $request->get('id')])->with('secret',$request->get('secret'));
    }

    private function encrypt($data, $secret)
    {
        $secret = md5(utf8_encode($secret), true);
        $secret = substr($secret, 0, 16);
        $iv = substr($secret, 0, 16);
        $blockSize = 128;
        $len = strlen($data);
        $pad = $blockSize - ($len % $blockSize);
        $data .= str_repeat(chr($pad), $pad);
        $encData = openssl_encrypt($data, 'aes128', $secret, OPENSSL_RAW_DATA, $iv);
        return base64_encode($encData);
    }

    private function decrypt($data, $secret)
    {
        $secret = md5(utf8_encode($secret), true);
        $secret = substr($secret, 0, 16);
        $data = base64_decode($data);
        $iv = substr($secret, 0, 16);
        $data = openssl_decrypt($data, 'aes128', $secret, OPENSSL_RAW_DATA, $iv);
        $len = strlen($data);
        $pad = ord($data[$len-1]);
        return  substr($data, 0, strlen($data) - $pad);
    }
}
