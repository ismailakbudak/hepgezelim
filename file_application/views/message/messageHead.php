     
    <style type="text/css">
        .btn-group-justified { display: table;
                               width: 80%;
                               border-collapse: separate;
                               table-layout: fixed;  }
        .unread { background-color: #00C417 !important; }
        .alert-info h4 {   margin-top: 10px;  }   
        .trip-content h4{font-size:17px };
    </style>
                    
  
         <div class="bs-example" style="margin-bottom: 15px;">
              <div class="btn-group btn-group-justified">
                <a id="inbox"    href="<?= new_url('message')    ?>" class="btn btn-default set" > <i class="text-warning glyphicon glyphicon-cloud-download two"></i> <?=  lang("m.inbox") ?> </a>
                <a id="send"     href="<?= new_url('message/send')    ?>" class="btn btn-default set" > <i class="text-success glyphicon glyphicon-cloud-upload two"></i> <?=  lang("m.sent") ?> </a>
                <a id="archieve" href="<?= new_url('message/archieve') ?>" class="btn btn-default set" > <i class="text-info glyphicon glyphicon-folder-close two"></i> <?=  lang("m.archive") ?> </a>
                <a id="blocked"  href="<?= new_url('message/block')    ?>" class="btn btn-default set" > <i class="text-danger glyphicon glyphicon-lock two"></i> <?=  lang("m.block") ?>  </a> 
              </div>
  
         </div>
         <div class="col-lg-12" style="margin-top:10px;">