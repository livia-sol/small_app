<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();

        if($users){
            $responses['percent'] = ['Good' => 0, 'Fair' => 0, 'Neutral' => 0, 'Bad' => 0];
            $responses['number'] = ['Good' => 0, 'Fair' => 0, 'Neutral' => 0, 'Bad' => 0];
            foreach($responses['percent'] as $key => $value){
                $responses['percent'][$key] = round(count(User::where("response", $key)->get()) * 100 / count($users), 2);
                $responses['number'][$key] = round(count(User::where("response", $key)->get()), 2);
            }
        }
        
        return response()->json($responses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $responses = ['Good', 'Fair', 'Neutral', 'Bad']; 
        return view('users.create', compact('responses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'response' => 'required'
        ];  

        $messages = [ 
            'required'  => __('app.:attribute is_required'),
            'email'    => __('app.:attribute must_be_valid_email'),
            'unique' =>  __('app.:attribute must_have_unique_value'),
         ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {    
            $errorMessages = [];
            foreach($validator->messages()->get('*') as $errorField)
                foreach($errorField as $message)
                    $errorMessages []= $message;
            $errors = implode(" ", $errorMessages);
            return(json_encode(['fail' => true, 'errors' => $errors]));
        }
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'response' => $request->response
        ]);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
