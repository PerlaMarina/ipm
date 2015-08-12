<?php

class ConfiguracionTrampaController extends BaseController{

    public function index(){
        $trampas = ViewConfiguracionTrampa::all();    
        return View::make('trampa.index')->with('trampas',$trampas);
    }

    public function getConfiguracionTrampa(){
      		
		$cfgtrampa = ViewConfiguracionTrampa::all();	
        //procces number field, for Typeahead library, needs to be a character.
        foreach ($cfgtrampa as $item)
        {
            $item->notrampa = strval($item->notrampa);
        }
            
		return Response::json(array(
			'error' => false,
			'cfgtrampas' => $cfgtrampa->toArray()),
			200
		);
			
    }
    
    
    /**
     * GET:  
     */ 
    public function getUbicaciones(){

        $ubicaciones = Ubicacion::all();	 
        
        return Response::json(array(
            'error' => false,
            'ubicaciones' => $ubicaciones->toArray()),
                              200
                             );

    }
    
    //POST 
    public function handleCreate()
    {
        // Handle create form submission.
		 if(Request::ajax())
		{
			$trampa = new ConfiguracionTrampa;
			$trampa->number        = Input::get('numero');        
			$trampa->idtipotrampa     = Input::get('idtipotrampa');
			$trampa->idclasificaiontrampa     = Input::get('idclasificaiontrampa');
			$trampa->idubicacion     = Input::get('idubicacion');
			$trampa->description    = Input::get('description');
			
			$trampa->save();
			
			$resultado = array(
				'status' => 'success',
				'msg' => 'created successfully'
			);
			
			
			return Response::json( $resultado );
		}
        //return Redirect::action('ConfiguracionTrampaController@index');
         /*$rules = array(
        'number'   => 'required|min:1',
        'description'      => 'required'
        );
        $validator = Validator::make($trampa->toArray(), $rules);

        if ($validator->passes()) {
            $trampa->save();
            return Redirect::action('ConfiguracionTrampaController@index');
        }
       else
         return Redirect::to('/create')->withErrors($validator);
            //return Redirect::action('TodoController@handleCreate')->withErrors($validator);
        */
    }
}