<?php

class EventoController extends BaseController{

    //make the VIEW HTML
    public function getIndex(){
        return View::make('evento.index');
    }
    //GET
    /**
     * Gel all events headers, to display in Grid.
     */ 
    public function getEventos(){

        $eventos = ViewEventosHeader::all();	 
        return Response::json(array(
            'error' => false,
            'eventos' => $eventos->toArray()),
                              200
                             );


    }
    /**
    * GET
    * Get Detail for current event.
    */ 
    public function getDetail($idevento){	
        // $idevento = Input::get('idevento');
        $eventos = ViewEventoDetalle::where('idevento',$idevento)->get();	 
        return Response::json(array(
            'error' => false,
            'eventosdetalle' => $eventos->toArray()),
                              //'idevento' => $idevento),
                              200
                             );


    }

    //POST 
    public function handleCreate()
    {
        try{

            if(Request::ajax())
            {
                $error=false;
                $idEvento = Input::get('idevento');

                $eventoUpdated = Evento::find($idEvento);
                if($eventoUpdated)
                {
                    $eventoUpdated->idconfiguraciontrampa  = Input::get('idctrampa');
                    $eventoUpdated->fechaevento  = Input::get('fechaevento');
                    $eventoUpdated->idclasificaiontrampa  = Input::get('idclasificacion');            
                    $eventoUpdated->semana  = Input::get('semana');
                    $eventoUpdated->observaciones  = Input::get('observaciones');
                    $eventoUpdated->save();
                }
                else{
                    $evento = new Evento;             

                    $evento->idconfiguraciontrampa  = Input::get('idctrampa');
                    $evento->fechaevento  = Input::get('fechaevento');
                    $evento->idclasificaiontrampa  = Input::get('idclasificacion');            
                    $evento->semana  = Input::get('semana');
                    $evento->observaciones  = Input::get('observaciones');
                    $evento->save();


                }

                $resultado = array(
                    'error' => false,				
                    'msg' => 'created successfully'
                );


                return Response::json( $resultado );
            }
        }
        catch(Exception $ex)
        {
            $resultado = array(
                'error' => true,				
                'msg' => 'Error saving data'
            );
            return Response::json( $resultado );
        }

    }
    
    /**
     * POST: Evento detalle
     */ 
    public function EventoDetailCreate()
    {
        try{

            if(Request::ajax())
            {
                
                //$idEvento = Input::get('idevento');
                $idDetalle = Input::get('iddetalle');
                $idPlaga = Input::get('idplaga');

                //$eventoUpdated = DetalleEvento::where('idevento',$idEvento)->where('idplaga',$idPlaga)->first();
                $eventoUpdated = DetalleEvento::find($idDetalle);
                if($eventoUpdated)
                {
                    //$eventoUpdated->idevento  = Input::get('idevento');
                    $eventoUpdated->idplaga  = Input::get('idplaga');
                    $eventoUpdated->cantidad  = Input::get('cantidad');            
                    
                    $eventoUpdated->save();
                }
                else{
                    $detalleevento = new DetalleEvento;             

                    $detalleevento->idevento  = Input::get('idevento');
                    $detalleevento->idplaga  = Input::get('idplaga');
                    $detalleevento->cantidad  = Input::get('cantidad');
                    $detalleevento->save();


                }

                $resultado = array(
                    'error' => false,				
                    'msg' => 'created successfully'
                );


                return Response::json( $resultado );
            }
       }
        catch(Exception $ex)
        {
            $resultado = array(
                'error' => true,	
                'exception' => $ex,
                'msg' => 'Error saving data'
            );
            return Response::json( $resultado );
        }

    }

}