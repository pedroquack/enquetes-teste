<?php

namespace App\Http\Controllers;

use App\Events\UpdateVotes;
use App\Models\Option;
use App\Models\Poll;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function index()
    {
        $polls = Poll::all();
        return view('poll.index',compact('polls'));
    }

    public function create()
    {
        return view('poll.create');
    }

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

    public function show($id)
    {
        $poll = Poll::find($id);
        if(!isset($poll)){
            return redirect()->back()->with('msg','Enquete não encontrada!');
        }

        return view('poll.show',compact('poll'));
    }

    public function edit($id)
    {
        $poll = Poll::find($id);
        if(!isset($poll)){
            return redirect()->back()->with('msg','Enquete não encontrada!');
        }

        return view('poll.edit',compact('poll'));
    }

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

        if(!isset($poll)){
            return redirect()->back()->with('msg','Enquete não encontrada!');
        }

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

    public function destroy($id)
    {
        $poll = Poll::find($id);
        if(!isset($poll)){
            return redirect()->back()->with('msg','Enquete não encontrada!');
        }

        $poll->delete();
        return redirect()->route('poll.index')->with('msg','Enquete excluída com sucesso!');
    }

    public function vote(Request $request){
        $request->validate([
            'option' => ['required','integer'],
        ]);
        $option = Option::find($request->option);
        if(!isset($option)){
            return redirect()->back()->with('msg','Opção não encontrada!');
        }
        if(!now()->between($option->poll->start_date,$option->poll->final_date)){
            return redirect()->back()->with('msg','Esta enquete não pode receber votos!');
        }
        $option->votes++;
        $option->save();

        UpdateVotes::dispatch($option);

        return redirect()->route('poll.show',$option->poll->id)->with('msg','Voto depositado com sucesso!');
    }
}
