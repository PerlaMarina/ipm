<?php

class DetalleEvento extends Eloquent
{
    protected $table ='detalleevento';
    public $timestamps = false;
    //protected $primaryKey = array('idevento', 'idplaga');//'idevento'; //array('idevento', 'idplaga');
    //protected $guarded = array('idevento','idplaga','cantidad');
}