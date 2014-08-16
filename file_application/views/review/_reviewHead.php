    
    <style type="text/css">
        .btn-group-justified { display: table;
                               width: 80%;
                               border-collapse: separate;
                               table-layout: fixed;  }
        .unread { background-color: #00C417 !important; }
        .alert-info h4 {   margin-top: 10px;  }   
    </style>
                 
    <div class="bs-example" style="margin-bottom: 15px;">
            <div class="btn-group btn-group-justified">
              <a id="receive"   href="<?= new_url("review")       ?>" class="btn btn-default set"> <i class="text-info glyphicon glyphicon-import two"></i> <?= lang("r.received") ?>  </a>
              <a id="given"     href="<?= new_url("review/given") ?>" class="btn btn-default set"> <i class="text-success glyphicon glyphicon-export two"></i> <?= lang("r.given") ?>  </a>
              <a id="give-rate" href="<?= new_url("review/leaveRating")  ?>" class="btn btn-default set"> <i class="text-warning glyphicon glyphicon-comment two"></i> <?= lang("r.give") ?>   </a>
            </div>
    </div>
    <div class="col-lg-12" style="margin-top:10px;">