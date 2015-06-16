<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Export Data</title>
    <link href="<?php echo base_url();?>assets/css/cloud-admin.css" rel="stylesheet" media="screen" />
   
  </head>

	<body> 
		<div class="container">  			
	     <br/>		
  			<div class="row">
  				<div class="col-md-3"><!--<img src="<?php echo base_url();?>uploader/001.png" class="img-responsive img-rounded" />--><div class="well">Foto</div></div>
  				<div class="col-md-9">
          <form class="form-horizontal row-border"  method="post" id="form">
  				  <div class="form-group">
              <label class="col-md-2 control-label">Name </label>                                                       
              <label class="col-md-2 control-label"><?php echo $data->first_name." ".$data->mid_name." ".$data->last_name;?> </label>                            	                          
              
  				  </div>
            <div class="form-group">
              <label class="col-md-2 control-label">Phone </label>                                                        
              <label class="col-md-1 control-label">  <?php echo $data->phone1;?> </label>                                                                      
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label">Email</label>                                                        
              <label class="col-md-1 control-label"><?php echo $data->email1;?></label>                                                       
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label">Berat :</label>                                                        
                <div class="col-md-4">:                                   
                  <span><?php echo $data->weight;?></span>                                
                </div>    
                 <label class="col-md-2 control-label">Tinggi :</label>                                                        
                <div class="col-md-4">:                                   
                  <span><?php echo $data->height;?></span>                                
                </div>                    
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label">Mother Name </label>                                                        
              <label class="col-md-1 control-label"><?php echo $data->mother_name;?></label>                                                        
                
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label">Nick Name </label>                                                        
              <label class="col-md-1 control-label"><?php echo $data->nick_name;?></label>                                                        
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label">Tempat Tanggal Lahir </label>                                                        
              <label class="col-md-2 control-label"><?php echo $data->birthplace.", ".$data->birthdate;?></label>                                                        
               
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label">Jenis Kelamin</label>                                                        
              <label class="col-md-1 control-label"><?php if($data->sex_type_id == 1)echo "Laki - Laki";elseif($data->sex_type_id == 2) echo "Perempuan"; else echo "Unidentify";?></label>                                                        
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label">Religion</label>                                                        
              <label class="col-md-1 control-label"><?php echo $data->religion;?></label>                                                                      
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label">Marital Status </label>                                                        
              <label class="col-md-1 control-label"><?php echo $data->marital_id;?> </label>                                                                      
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label">Culture</label>                                                        
              <label class="col-md-1 control-label"><?php echo $data->ethnic_id;?></label>                                                                        
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label">Blood Type </label>                                                        
              <label class="col-md-1 control-label"><?php echo $data->blood_type_id;?></label>                                                                        
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label">Address </label>                                                        
                <div class="col-md-8">                                                    
                  <?php echo $data->address1;?>                  
                  <label class="col-md-2 control-label">RT </label>                                                        
                  <label class="col-md-1 control-label"><?php echo $data->Adr1RT;?></label>         
                  <label class="col-md-2 control-label">RW </label>                                                        
                  <label class="col-md-1 control-label"><?php echo $data->Adr1RW;?></label>                                                                        
                  <label class="col-md-2 control-label">Kelurahan </label>                                                        
                  <label class="col-md-1 control-label"><?php echo $data->Adr1LRH;?></label>         
                  <label class="col-md-2 control-label">Kecamatan </label>                                                        
                  <label class="col-md-1 control-label"><?php echo $data->Adr1KCM;?></label>         
                  <label class="col-md-2 control-label">Kode Pos </label>                                                        
                  <label class="col-md-1 control-label"><?php echo $data->zip1;?></label>       
                  <label class="col-md-2 control-label">Province </label>                                                        
                  <label class="col-md-1 control-label"><?php echo $data->provinsi1;?></label>           
                  <label class="col-md-2 control-label">Disctrict </label>                                                        
                  <label class="col-md-1 control-label"><?php echo $data->district_id1;?></label>         
                </div>            
            </div>
              
            </form>
			     </div>
        </div>
      <!-- PAGE table -->
      <div class="row">
    <div class="col-md-12">
      <!-- BOX -->
      <div class="box border green">
        <div class="box-title">
          <h4><i class="fa fa-table"></i>Official</h4>           
        </div>
        <div class="box-body">
          <form class="form-horizontal row-border"  method="post" id="form">
            <div class="form-group">
              <label class="col-md-2 control-label">Start Date </label>                                                       
               <div class="col-md-3">
                  <?php echo $data->start_join; ?>
               </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label">End Date </label>                                                       
               <div class="col-md-3">
                <?php echo $data->end_join; ?>
               </div>
            </div>
            <div class="form-group">
                                <label class="col-md-2 control-label">ID Card/Valid Until</label>
                                
                                   
                                        <div class="col-md-2">
                                            <?php echo $data->card_id; ?>
                                        </div>
                                        <div class="col-md-3">
                                         
                                               <?php echo $data->card_exp; ?>
                                         
                                        </div>
                                   
                                
                            </div> 
            <div class="form-group">                                             
              <label class="col-md-2 control-label">Division</label>
              <div class="col-md-4">
                <?php echo $data->divisi; ?>
              </div>
            </div>
             <div class="form-group">                                             
              <label class="col-md-2 control-label">Structural</label>
              <div class="col-md-4">
                <?php echo $data->stuctural; ?>
              </div>
            </div>
             <div class="form-group">                                             
              <label class="col-md-2 control-label">Functional</label>
              <div class="col-md-4">
                <?php echo $data->fucntional; ?>
              </div>
            </div>  
            <div class="form-group">                                             
              <label class="col-md-2 control-label">Entry Gate Name</label>
              <div class="col-md-4">
                <?php //echo $data->fucntional; ?>
              </div>
            </div>
            <div class="form-group">                                             
              <label class="col-md-2 control-label">Employee Number</label>
              <div class="col-md-4">
                <?php echo $data->code; ?>
              </div>
            </div>             
          </form>
            </div>
        </div>
        
      </div>
      <!-- /BOX -->
    </div>
      

      <!-- PAGE table -->
      <div class="row">
        <div class="col-md-12">
        <!-- BOX -->
        <div class="box border blue">
          <div class="box-title">
          <h4><i class="fa fa-table"></i>Education</h4>           
        </div>
        <div class="box-body">
          <table class="table">
            <thead>
              <tr>
                  <th>Mulai</th>
                  <th>Berakhir</th>
                  <th>Sekolah / Pendidikan</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                foreach($data_pendidikan as $key=>$value){
                  echo "<tr>";
                    echo "<td>".$value->START_DATE."</td>";
                    echo "<td>".$value->END_DATE."</td>";
                    echo "<td>".$value->COMPANY_NAME." - ".$value->type_name."</td>";
                  echo "</tr>";

                }
              ?>
            </tbody>
          </table>
        </div>     
      </div>
      <!-- /BOX -->
    </div>
  </div>
  <!-- PAGE table -->
  <div class="row">
    <div class="col-md-12">
      <!-- BOX -->
      <div class="box border red">
        <div class="box-title">
          <h4><i class="fa fa-table"></i>Expereances</h4>           
        </div>
        <div class="box-body">
          <table class="table">
            <thead>
              <tr>
                  <th>Mulai</th>
                  <th>Berakhir</th>
                  <th>Sekolah / Pendidikan</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                foreach($data_pekerjaan as $key=>$value){
                  echo "<tr>";
                    echo "<td>".$value->START_DATE."</td>";
                    echo "<td>".$value->END_DATE."</td>";
                    echo "<td>".$value->COMPANY_NAME." - ".$value->PERFORMANCE."</td>";
                  echo "</tr>";

                }
              ?>
            </tbody>
          </table>
        </div>
        
      </div>
      <!-- /BOX -->
    </div>
  </div>

  <style type="text/css">

  </style>
	</body>
	
</html>