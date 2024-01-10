<?php

namespace App\Services;

use Form;
use Collective\Html\FormBuilder;

/**
 * Macros de formulario
 */
class Macros extends FormBuilder
{

    function __construct()
    {
        # code...
    }
    /**
     * Boton para regresar al formulario anterior
     * @param string $value [description]
     */
    public function Back()
    {
        Form::macro('back', function ($url) {
            return '
            
            <a href="'.$url.'"class="btn btn-outline-warning m-btn m-btn--icon m-btn--outline-2x m-btn--pill">
															<span>
																<i class="fa flaticon-reply"></i>
																<span>Regresar</span>
															</span>
														</a>
            
            
    

            ';
        });
    }
    /**
     * Boton para hacer Submit
     * @param string $value [description]
     */
    public function Enviar()
    {
        Form::macro('enviar', function ($name,$color = 'green',$iconclass = 'fa-save') {

            return '
            	<button id="btnchang" type="submit" class="btn '.$color.' uppercase">
            	<i class="fa '.$iconclass.'"></i>
            	'.$name.'
            	</button>
            ';
        });
    }
    /**
     * Boton link
     */
    public function Boton()
    {
        Form::macro('boton',function($name,$url,$color = '',$icon = null,$botonclass=null,$data = []){
            $iconclass = (isset($icon)) ? '<i class="'.$icon.'"></i>' : '' ;
            $atributos = '';

            foreach ($data as $key => $value) {
                $atributos .= $key.'="'.$value.'"';
            }

            return '
				<a href="'.$url.'" class="btn '.$botonclass.' '.$color.'" '.$atributos.'>
	                '.$iconclass.'
	                '.$name.'
	            </a>
			';
        });

    }
    /**
     * Boton Modal
     */
    public function BotonModal()
    {
        Form::macro('botonmodal',function($name,$url,$color = '',$icon = null,$botonclass=null){
            $iconclass = (isset($icon)) ? '<i class="'.$icon.'"></i>' : '' ;
            return '
				<a href="'.$url.'" data-toggle="modal" class="btn '.$botonclass.' '.$color.'">
	                '.$iconclass.'
	                '.$name.'
	            </a>
			';
        });
    }
    /**
     * Menu
     */
    public function Menu()
    {
        Form::macro('menu',function($name,$url,$icon = null,$start=null){
            $iconclass = (isset($icon)) ? '<i class="m-menu__link-icon '.$icon.'"></i>' : '' ;




            return '
				<li class="m-menu__item '.$start.' ">
		            <a href="'.$url.'" class="m-menu__link">
		               '.$iconclass.'
		               <span class="m-menu__link-title"> 
		               <span class="m-menu__link-wrap"> 
		               <span class="m-menu__link-text">'.$name.'</span>
		               </span>
		               </span>
		              
		            </a>
		        </li>
			';
        });

    }
    /**
     * Menu LINK
     */
    public function MenuLink()
    {
        Form::macro('menulink',function($name,$url,$icon = null){
            $iconclass = (isset($icon)) ? '<i class="'.$icon.'"></i>' : '' ;

            return '
		            <a href="'.$url.'" class="nav-link nav-toggle">
		               '.$iconclass.'
		                <span class="title">'.$name.'</span>
		                <span class="arrow"></span>
		            </a>
			';
        });

    }

}

