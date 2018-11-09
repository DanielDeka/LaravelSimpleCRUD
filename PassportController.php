//PassportController.php
/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasfile('filename'))
         {
            $file = $request->file('filename');
            $name=time().$file->getClientOriginalName();
            $file->move(public_path().'/images/', $name);
         }
        $passport= new \App\Passport;
        $passport->name=$request->get('name');
        $passport->email=$request->get('email');
        $passport->number=$request->get('number');
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $passport->date = strtotime($format);
        $passport->office=$request->get('office');
        $passport->filename=$name;
        $passport->save();
        
        return redirect('passports')->with('success', 'Information has been added');
    }
