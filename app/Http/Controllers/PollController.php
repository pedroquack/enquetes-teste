<?php

namespace App\Http\Controllers;

use App\Events\UpdateVotes;
use App\Models\Option;
use App\Models\Poll;
use Illuminate\Http\Request;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polls = Poll::all();
        return view('poll.index',compact('polls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('poll.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'start_date' => ['date',],
            'final_date' => ['date','after:start_date'],
            'options' => ['required','array','min:3'],
            'options.*' => ['required','string']
        ]);

        $poll = Poll::create([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'final_date' => $request->final_date,
        ]);

        foreach($request->options as $option){
            Option::create([
                'text' => $option,
                'poll_id' => $poll->id
            ]);
        }

        return redirect()->route('poll.show',$poll->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $poll = Poll::find($id);

        return view('poll.show',compact('poll'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $poll = Poll::find($id);

        return view('poll.edit',compact('poll'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required'],
            'start_date' => ['date',],
            'final_date' => ['date','after:start_date'],
            'options' => ['required','array','min:3'],
            'options.*' => ['required','string']
        ]);

        $poll = Poll::find($id);

        $poll->title = $request->title;
        $poll->start_date = $request->start_date;
        $poll->final_date = $request->final_date;
        $poll->save();

        $poll->options()->delete();

        foreach($request->options as $option){
            Option::create([
                'text' => $option,
                'poll_id' => $poll->id
            ]);
        }

        return redirect()->route('poll.show',$poll->id)->with('msg','Enquete atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $poll = Poll::find($id);
        if(!isset($poll)){
            abort(404, 'Enquete não encontrada!');
        }

        $poll->delete();
        return redirect()->route('poll.index')->with('msg','Enquete excluída com sucesso!');
    }

    public function vote(Request $request){
        $request->validate([
            'option' => ['required','integer'],
        ]);
        $option = Option::find($request->option);
        $option->votes++;
        $option->save();

        UpdateVotes::dispatch($option);

        return redirect()->route('poll.show',$option->poll->id)->with('msg','Voto depositado com sucesso!');
    }
}
