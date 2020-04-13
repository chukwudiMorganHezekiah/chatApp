<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use App\User;
use DB;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //select the users
        $all=User::where('id','!=',auth()->user()->id)->get();

        //select the count
        $user=auth()->user()->id;

        $unreads=Message::select(\DB::raw('`from` as sender_id,count(`from`) AS message_count'))
        ->where('to',auth()->id())
        ->where('read',false)
        ->groupBy('from')
        ->get();

        $contacts=$all->map(function($single) use ($unreads){
            $countUnrread=$unreads->where('sender_id',$single->id)->first();

            $single->unread=$countUnrread ? $countUnrread->message_count :0;

        });


        return response()->json($all,200);
    }

    public function messages($id){
        $user=auth()->user()->id;
        $messages=Message::where(function($q) use($id,$user){
            $q->where('from',$user);
            $q->where('to',$id);

        })->orWhere(function($q) use ($id,$user){
            $q->where('to',$user);
            $q->where('from',$id);

        })->get();
        return response()->json($messages,200);

    }

    public function add(Request $request){
        $from=auth()->user()->id;
        $to=$request->contact_id;
        $message=$request->message;

       $saved=DB::insert("INSERT INTO messages (`from`,`to`, `message`) VALUE ('$from','$to', '$message')");
       $send=['from'=>$from,'to'=>$to,'message'=>$message];
        return response()->json($send,200);





    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
