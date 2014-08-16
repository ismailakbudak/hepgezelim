<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


  /****
   |  Mail send user message about the review 
   |  @parameter | receiver, sender, language
   |  @return    | html content 
   |
  ****/    
  function mailNewReview( $receiver, $sender, $lang ){
        $cont = mailHeader(); 
        $cont .='  
             <tr>
                  <td style="color:#555555;font-family:Helvetica,Arial,sans-serif;" valign="top">
                              <p style="color:#0BBFC7; font-size:100%;">
                                  '. lang('e.hello') . $receiver['name']  .'
                              </p>
                              <p style="width:95%;line-height:1.5em;font-size:100%;color:#333333;">
                                     <strong style="color:#079213; font-size:100%;"> 
                                      '.  $sender['name']  .'
                                      </strong>  
                                      '. lang('re.rating')  .' 
                                   <br>
                              </p>

                              <p style="font-family:Helvetica,Arial,sans-serif;color:#555555;">
                                   '. lang('e.niceride') .'
                               </p>
                               <p style="font-family:Helvetica,Arial,sans-serif;color:#555555;">
                                   '. lang('e.team')   .'
                               </p>
                   </td>
            </tr>';
            $cont .= mailFooter(); 
            return $cont; 
  }

  /****
   |  Mail send user message about the contact 
   |  @parameter | name, password
   |  @return    | html content 
   |
  ****/    
  function mailSendMessageUser($receiver, $sender, $offer, $lang){
        $cont = mailHeader(); 
        $cont .='  
             <tr>
                  <td style="color:#555555;font-family:Helvetica,Arial,sans-serif;" valign="top">
                              <p style="color:#0BBFC7; font-size:100%;">
                                  '. lang('e.hello') . $receiver['name']  .'
                              </p>
                              <p style="width:95%;line-height:1.5em;font-size:100%;color:#333333;">
                                     <strong style="color:#079213; font-size:100%;"> 
                                      '.  $sender['name']  .'
                                      </strong>  
                                      '. lang('me.contact')  .' 
                                   <br>
                              </p>
                              <table style="padding:0px 10px 0 10px;" align=left bgcolor=#F5F5F5 border=0 cellpadding=10 cellspacing=0 width=100%>
                                  <tbody>
                                     <tr>
                                          <td style="background:#e1e1e1;color:#555555;" >
                                              <strong> '. lang('me.offer') .'  </strong>
                                         </td>
                                     </tr>
                                     <tr> <td height=1></td> </tr>
                                  </tbody>
                              </table>
                              <table style="color:#555555;padding:0px 10px 0 10px;font-size:88%;" align=left bgcolor=#F5F5F5 border=0 cellpadding=10 cellspacing=0 width=100%>
                                    <tbody>
                                           <tr>
                                              <td style="border-bottom:1px solid #E3E0E0;padding-top:0;" align=left width=120>
                                                  '.lang("me.from").'
                                              </td>
                                              <td style="border-bottom:1px solid #E3E0E0;padding-top:0;" align=left>
                                                  <img src="'.  str_replace(" http://","",base_url("styles/images/search-from.png")) .'" alt="" align=absmiddle >
                                                  <b>'. $offer['origin'] .'</b>
                                              </td>
                                           </tr>
                                           <tr>
                                              <td style="border-bottom:1px solid #E3E0E0;border-top:1px solid #ffffff;" align=left>
                                                 '.lang("me.to").'
                                              </td>
                                              <td style="border-bottom:1px solid #E3E0E0;border-top:1px solid #ffffff;" align=left>
                                                  <img src="'.  str_replace(" http://","",base_url("styles/images/search-to.png")) .'" alt="" align=absmiddle >
                                                  <b> '. $offer['destination'] .' </b>
                                              </td>
                                           </tr>
                                           <tr>
                                                 <td style="border-bottom:1px solid #E3E0E0;border-top:1px solid #ffffff;" align=left>
                                                    '.lang("me.departure_date").'
                                                 </td>
                                                 <td style="border-bottom:1px solid #E3E0E0;border-top:1px solid #ffffff;" align=left>
                                                     <b>
                                                         ' . dateConvert($offer['departure_date'] ." ". $offer['departure_time'], $lang) .'
                                                     </b>
                                                 </td>
                                           </tr>';
                          if(  strcmp( $offer['round_trip'], "1" ) == 0 ){              
                                $cont .=' 
                                           <tr>
                                                 <td style="border-bottom:1px solid #E3E0E0;border-top:1px solid #ffffff;" align=left>
                                                     '.lang("me.return_date").'
                                                 </td>
                                                 <td style="border-bottom:1px solid #E3E0E0;border-top:1px solid #ffffff;" align=left>
                                                     <b> <b> '. dateConvert($offer['return_date'] ." ". $offer['return_time'], $lang) .' </b> </b>
                                                 </td>
                                           </tr>';
                            }           

                                $cont .=' 
                                           <tr>
                                               <td style="border-bottom:1px solid #E3E0E0;border-top:1px solid #ffffff;" align=left>
                                                   '.lang("me.seat").'
                                               </td>
                                               <td style="border-bottom:1px solid #E3E0E0;border-top:1px solid #ffffff;" align=left>
                                                   <b>
                                                       '. $offer['number_of_seats'] ." " . lang("me.available") . '
                                                   </b>
                                               </td>
                                           </tr>
                                           <tr>
                                               <td style="padding-bottom:0;border-top:1px solid #ffffff;" align=left>
                                                   '.lang("me.price").'
                                               </td>
                                               <td style="padding-bottom:0;border-top:1px solid #ffffff;" align=left>
                                                   <b>
                                                      '. $offer['price_per_passenger'] .'₺' . lang("me.tl") .'
                                                   </b>
                                               </td>
                                           </tr>
                                   </tbody>
                              </table>
                              <table align=center bgcolor=#F5F5F5 border=0 cellpadding=0 cellspacing=0 width=100%>
                                    <tbody>
                                       <tr> <td height=25></td>  </tr>
                                       <tr>
                                           <td align=center width=543>
                                               <table style="font-family:arial,helvetica,sans-serif;font-size:16px;" border=0 cellpadding=10 cellspacing=0 width=auto>
                                                   <tbody><tr>
                                                       <td style="color:#ffffff;background:#0ca9fa;height:10px;border-bottom:2px solid #0d8fc9;border-right:1px solid #0d8fc9;border-radius:3px;text-decoration:none;" align=center valign=middle>
                                                           <a href="'.   str_replace(" http://","",new_url('message/inbox/'. urlencode(base64_encode( $offer['id'] )) ."/" . urlencode(base64_encode( $sender['id'] )) ) ) .'" style="text-decoration:none;color:#FFFFFF; width:200px;" target=_blank>
                                                               <span style="color:#FFFFFF; ";>
                                                                   '.lang("me.seemessage").'
                                                               </span>
                                                           </a>
                                                       </td>
                                                   </tr>
                                               </tbody></table>
                                           </td>
                                       </tr>
                                       <tr>
                                           <td height=10></td>
                                       </tr>
                                    </tbody>
                              </table>            
                              <p style="font-family:Helvetica,Arial,sans-serif;color:#555555;">
                                   '. lang('e.niceride') .'
                               </p>
                               <p style="font-family:Helvetica,Arial,sans-serif;color:#555555;">
                                   '. lang('e.team')   .'
                               </p>
                   </td>
            </tr>';
            $cont .= mailFooter(); 
            return $cont; 
  }

  /****
   |  mail for new password action
   |  @parameter | name, password
   |  @return    | html content 
   |
  ****/ 
  function mailNewPassword($name, $password, $email = "" ){
        $email = my_encode($email);
        $cont = mailHeader(); 
        $cont .='  
             <tr>
                  <td style="color:#555555;font-family:Helvetica,Arial,sans-serif;" valign="top">
                              <p style="color:#0BBFC7; font-size:100%;">
                                  '. lang('e.hello') . $name  .'
                              </p>
                              <p style="width:95%;line-height:1.5em;font-size:100%;color:#333333;">
                                   '. lang('e.resend')  .' 
                                   <br>
                              </p>
                              <p style="width:95%;line-height:1.5em;font-size:100%;color:#333333;">
                                    '. lang('e.newpassword') .':   
                                    <strong> 
                                        '. $password .' 
                                    </strong>
                              </p>
                              <p style="width:95%;line-height:1.5em;font-size:100%;color:#333333;">
                                    '. lang('e.or_click2') .'  
                              </p>
                              <p style="width:95%;line-height:1.5em;font-size:100%;color:#333333;">
                                        '. new_url( 'user/password?new=' . $email ) .' 
                              </p>
                              <p style="font-family:Helvetica,Arial,sans-serif;color:#555555;">
                                   '. lang('e.niceride') .'
                               </p>
                               <p style="font-family:Helvetica,Arial,sans-serif;color:#555555;">
                                   '. lang('e.team')   .'
                               </p>
                   </td>
            </tr>';
            $cont .= mailFooter(); 
            return $cont;   
  }
  
  /****
   |  mmail new user content 
   |  @parameter | name, password
   |  @return    | html content 
   |
  ****/ 
  function mailNewUser($name, $code, $again, $email = "" ){ 
        $cont  = mailHeader();
        $email = my_encode( $email );
        $cont .='  
             <tr>
                  <td style="color:#555555;font-family:Helvetica,Arial,sans-serif;" valign="top">
                              <p style="color:#0BBFC7; font-size:100%;">
                                  '. lang('e.hello') . $name  .'
                              </p>
                              <p style="width:95%;line-height:1.5em;font-size:100%;color:#333333;">
                                   '.  $var = (($again == FALSE) ? lang('e.welcome') : lang('e.again'))  .' 
                                   <br>
                              </p>
                              <p style="width:95%;line-height:1.5em;font-size:100%;color:#333333;">
                                    '. lang('e.verify') .'  
                                    <strong> 
                                        '. $code .' 
                                    </strong>
                              </p>
                              <p style="width:95%;line-height:1.5em;font-size:100%;color:#333333;">
                                    '. lang('e.or_click') .'  
                              </p>
                              <p style="width:95%;line-height:1.5em;font-size:100%;color:#333333;">
                                        '. new_url( 'user/verify?onay=' . $email ) .' 
                              </p>
                              <p style="font-family:Helvetica,Arial,sans-serif;color:#555555;">
                                   '. lang('e.niceride') .'
                               </p>
                               <p style="font-family:Helvetica,Arial,sans-serif;color:#555555;">
                                   '. lang('e.team')   .'
                               </p>
                   </td>
            </tr>';
            $cont .= mailFooter(); 
            return $cont;   
   }
  
    
  /****
   |  Mail content Header 
   |  @parameter | name, password
   |  @return    | html content 
   |
  ****/  
  function mailHeader(){
        $head = '<style>
                    .ExternalClass {
                       background-color:#bff0ff;
                       font-size:100%;
                       font-family:Helvetica,Arial,sans-serif;
                    }
                    </style>
                      <center style="background-color:#bff0ff;" bgcolor="#bff0ff; " >
                        <table style="font-family:Helvetica,Arial,sans-serif;font-size:100%;background-color:#bff0ff;" bgcolor="#bff0ff" border="0" cellpadding="0" cellspacing="0" width="608">
                          <tbody>
                            <tr>
                                <td colspan="3" style="" bgcolor="#bff0ff" align="left" height="54" valign="bottom"></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="" bgcolor="#FFFFFF" align="left" height="8" valign="top"></td>
                            </tr>
                            <tr>
                                <td style="" bgcolor="#FFFFFF" valign="top" width="4"></td>
                                <td valign="top">
                                    <table style="background-color:#FFFFFF;" bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tbody><tr>
                                            <td style="padding:0 26px;">
                                                <table style="background-color:#FFFFFF;" bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                    <tbody><tr>
                                                        <td>
                                                            <table style="background-color:#FFFFFF;padding:12px 0 18px;" bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                <tbody><tr>
                                                                    <td align="left" height="41" width="177">
                                                                        <a href="'.  str_replace(" http://","", new_url()) .'" target="_blank">
                                                                          <img src="'.  str_replace(" http://","", base_url('styles/images/ico.png')) .'" alt="" border="0" width="30" height="30"></a>
                                                                    <td align="right" valign="middle">
                                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody><tr>
                                                                                <td align="right">
                                                                                    <span style="color:#555555;font-size:75%;">
                                                                                    </span>
                                                                                </td>
                                                                                <td style="padding-left:4px;" align="right" width="27">
                                                                                    <a href="www.facebook.com/hepgezelim" target="_blank">
                                                                                        <img src="'. str_replace(" http://","",base_url("styles/images/facebook-32.png") ) .'" alt="" border="0" ></a>
                                                                                </td>
                                                                                <td style="padding-left:4px;" align="right" width="29">
                                                                                    <a href="twitter.com/hepgezelim" target="_blank">
                                                                                        <img src="'.str_replace(" http://","", base_url("styles/images/twitter-32.png") ) .'" alt="" border="0"></a>
                                                                                </td>
                                                                                <!---
                                                                                <td style="padding-left:4px;" align="right" width="71">
                                                                                    <a href="ismailakbudak.com/blog" target="_blank">
                                                                                        <img src="'. str_replace(" http://","", base_url('styles/images/blogger-32.png') ).'" alt="" border="0"></a>
                                                                                </td>
                                                                                --->
                                                                            </tr>
                                                                        </tbody></table>
                                                                    </td>
                                                                </tr>
                                                            </tbody></table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="" bgcolor="#FFFFFF" height="2" valign="top">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="24"></td>
                                                    </tr>';
                                                  // <!-- Content is here -->
         return $head;
  }
  
  /****
       | Mail content footer 
       |  @parameter | name, password
       |  @return    | html content 
       |
  ****/   
  function mailFooter(){
      $foot = '
                                                    <tr>
                                                        <td height="30"></td>
                                                    </tr>
                                                  </tbody>
                                              </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                                <td style="" bgcolor="#FFFFFF" valign="top" width="4">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="" bgcolor="#FFFFFF" align="left" height="15" valign="top">
                                </td>
                            </tr>
                        </tbody>
                      </table>
                      <table style="padding:6px 0 6px 14px; margin-bottom: 40px; margin-top: 15px;" border="0" cellpadding="0" cellspacing="0" width="600">
                            <tbody><tr>
                                   <td align="left">
                                       <p style="color:#333333;font-size:75%;">
                                       '. lang('e.stop') .'                                           
                                       <a href="'.  str_replace(" http://","",new_url('profil/profile/notification')) .'" style="color:#000000;" target="_blank"> 
                                       '. lang('e.stopC') .'
                                       </a></p>
                                   </td>
                                   <td align="right">
                                       <p style="color:#333333;font-size:75%;padding-right:25px;">
                                          '. lang('e.copyright') .' 
                                       </p>
                                   </td>
                               </tr>
                             </tbody>
                       </table> 
                    </center>
                    ';
          return $foot;          
  }



?>