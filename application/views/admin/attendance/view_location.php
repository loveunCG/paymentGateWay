<style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 400px;
        width:500px;
      }
    </style>
    <script>
      var map;
      var marker ;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 18.4407618, lng: -64.5564185},
          zoom: 8
        });
        
       
      }
      
      function create_marker(id,lat,lng){
          
        var myLatLng = {lat: lat, lng: lng};
         
        if(typeof marker =='undefined'){
            
                 marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    title: 'Hello World!'
                  });
        }
        else{
         marker.setPosition(myLatLng);
        }
        a_cross_domain_url ='get_location/'+id;
        var jqxhr = $.ajax(  {  url: a_cross_domain_url,
                             } )
                        .done(function(data) {
                          //  console.log(data);
                           var obj = JSON.parse(data);
                          // console.log(obj[0]);
                           
                           RadioButtonSelectedValueSet("id",obj[0].id);
                           RadioButtonSelectedValueSet("optstatus",obj[0].status);
                           RadioButtonSelectedValueSet("optgps",obj[0].gps_required);
                         // alert( "success" );
                        })
                        .fail(function() {
                          alert( "error" );
                        });
 
 
        
         map.setCenter(marker.getPosition());
      }
    
     $(document).ready(function () {
         
      $('#btnsubmit').click(function(e){
          e.preventDefault();
          
          
         var postData = $('#frmmap').serialize();
          
           a_cross_domain_url ='save_location';
           
             var jqxhr = $.ajax(  {  
                                 url: a_cross_domain_url,
                                 data:postData,
                                 method:'post'
                             } )
                        .done(function(data) {
                          //  console.log(data);
                      // $('#mapAlert').removeClass( "alert alert-danger" ).addClass( "alert alert-success" );
                          alert( "success" );
                        })
                        .fail(function() {
                            
                        //    $('#mapAlert').removeClass( "alert alert-success" ).addClass( "alert alert-danger" );
                          alert( "error" );
                        });
      });
      
      //////////////////////////////////////////////////////////////////////////////////////////////////
      
     $('#btndelete').click(function(e){
          e.preventDefault();
               var postData = $('#frmmap').serialize();
          
           a_cross_domain_url ='delete_location';
           
             var jqxhr = $.ajax(  {  
                                 url: a_cross_domain_url,
                                 data:postData,
                                 method:'post'
                             } )
                        .done(function(data) {
                          //  console.log(data);
                      // $('#mapAlert').removeClass( "alert alert-danger" ).addClass( "alert alert-success" );
                                 window.location.reload(true);
                          //alert( "record deleted" );
                        })
                        .fail(function() {
                            
                        //    $('#mapAlert').removeClass( "alert alert-success" ).addClass( "alert alert-danger" );
                          alert( "error on delete" );
                        });
      });
      
      
      
    });
    
      function RadioButtonSelectedValueSet(name, SelectedValue) {
          $('input[name="' + name+ '"]').val([SelectedValue]);
      }

    </script>
<div class="row">
    <div class="col-sm-12">

        <div class="col-sm-3">
             <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Location</th>

                  </tr>
                </thead>
                <tbody>
                      <?php if (!empty($all_locations)): foreach ($all_locations as $location): ?>
                  <tr>
                      <td> <a href="javascript:void(0)" onclick="create_marker(<?php echo $location->id; ?>,<?php echo $location->lat; ?>,<?php echo $location->long; ?>)"><?php echo $location->name; ?></a></td>

                  </tr>
                     <?php
                            endforeach;
                            endif;
                      ?> 
                </tbody>
              </table>
        </div>
        <div class="col-sm-6">
             <div id="map"></div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAS8uCrRRltEn8L1vluAfrsQyQO81ARcVY&callback=initMap"
    async defer></script>
        </div>
        <div class="col-sm-3">
        
            <form id="frmmap">
               
                <input type="hidden" name="id" value="0">
               <div class="form-group">
                    <label for="optradio">Status:</label>
                    <div class="radio">
                        <label><input type="radio" name="optstatus" value="Approved">Approved</label>
                    </div>
                    <div class="radio">
                       <label><input type="radio" name="optstatus" value="Denied">Denied</label>
                    </div>
               </div>
                
              <div class="form-group">
                    <label for="optradio">Require GPS Clock in/out ?</label>
                    <div class="radio">
                       <label><input type="radio" name="optgps" value="1">Yes</label>
                    </div>
                    <div class="radio">
                       <label><input type="radio" name="optgps" value="0">No</label>
                    </div>
               </div>
			   
			   <div class="form-group">
                    <label for="optradio">Allow Employee App Clock in/out ?</label>
                    <div class="radio">
                       <label><input type="radio" name="optac" value="1">Yes</label>
                    </div>
                    <div class="radio">
                       <label><input type="radio" name="optac" value="0">No</label>
                    </div>
               </div>
			   
                
                <div class="form-group">
                    <button  id="btnsubmit">Submit</button>
                    <button  id="btndelete">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>