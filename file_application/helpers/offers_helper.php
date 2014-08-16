<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
         /**
          *   return colour  
          *   
          *   @param    
          *   @return    
         **/
        function getColour( $val ){
              $max = $val + 15;   
              $colour =  'green';
              if( $max <= 15  ){ 
                if( $val < $max - 8 )
                   $colour = 'green';
                else if($val < $max - 5 )
                   $colour = 'orange';
                else
                   $colour = 'red';
              }
              else if( $max < 20 ){ 
                 if( $val < $max - 10 )
                    $colour = 'green';
                 else if($val < $max - 4 )
                    $colour = 'orange';
                 else
                     $colour = 'red';
              }
              else if( $max < 30 ){ 
                 if( $val < $max - 19 )
                    $colour = 'green';
                 else if( $val < $max - 12  )
                    $colour = 'orange';
                 else
                     $colour = 'red';
              }
              else if( $max < 40 ){ 
                 if( $val < $max - 22 )
                    $colour = 'green';
                 else if($val < $max - 13 )
                    $colour = 'orange';
                 else
                     $colour = 'red';
              }
              else if( $max >= 40 ){ 
                 if( $val < $max - 30 )
                    $colour = 'green';
                 else if($val < $max - 14 )
                    $colour = 'orange';
                 else
                     $colour = 'red';
              }
              return $colour;
        }