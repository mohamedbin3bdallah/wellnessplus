

<section class="content">
  <div class="row">
    <div class="col-xs-12">

        <!-- /.box-header -->
        <div class="box-body">
         <form action="{{ route('icons.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
              
         
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>{{ __('dashboard.icon_dimensions', ['int1'=>36, 'int2'=>36]) }}: <sup class="redstar">*</sup></label>
                        <input type="file" class="form-control" name="icon36x36">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <img id="preview1" alt="preview" src="{{ url('/images/icons/icon36x36.png') }}">
                    </div>
                  </div>
            

           
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>{{ __('dashboard.icon_dimensions', ['int1'=>48, 'int2'=>48]) }}: <sup class="redstar">*</sup></label>
                        <input type="file" class="form-control" name="icon48x48">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <img id="preview2" alt="preview" src="{{ url('/images/icons/icon48x48.png') }}">
                    </div>
                  </div>
              

             
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>{{ __('dashboard.icon_dimensions', ['int1'=>72, 'int2'=>72]) }}: <sup class="redstar">*</sup></label>
                        <input type="file" class="form-control" name="icon72x72">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <img id="preview3" alt="preview" src="{{ url('/images/icons/icon72x72.png') }}">
                    </div>
                  </div>
               

               
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>{{ __('dashboard.icon_dimensions', ['int1'=>96, 'int2'=>96]) }}: <sup class="redstar">*</sup></label>
                        <input type="file" class="form-control" name="icon96x96">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <img src="{{ url('/images/icons/icon96x96.png') }}" class="img-responsive">
                    </div>
                  </div>
              

             
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>{{ __('dashboard.icon_dimensions', ['int1'=>144, 'int2'=>144]) }}: <sup class="redstar">*</sup></label>
                        <input type="file" class="form-control" name="icon144x144">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <img src="{{ url('/images/icons/icon144x144.png') }}" class="img-responsive">
                    </div>
                  </div>
             

             
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>{{ __('dashboard.icon_dimensions', ['int1'=>168, 'int2'=>168]) }}: <sup class="redstar">*</sup></label>
                        <input type="file" class="form-control" name="icon168x168">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <img src="{{ url('/images/icons/icon168x168.png') }}" class="img-responsive">
                    </div>
                  </div>
               

            
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>{{ __('dashboard.icon_dimensions', ['int1'=>192, 'int2'=>192]) }}: <sup class="redstar">*</sup></label>
                        <input type="file" class="form-control" name="icon192x192">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <img src="{{ url('/images/icons/icon192x192.png') }}" class="img-responsive">
                    </div>
                  </div>
               

              
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>{{ __('dashboard.icon_dimensions', ['int1'=>256, 'int2'=>256]) }}: <sup class="redstar">*</sup></label>
                        <input type="file"  class="form-control" name="icon256x256">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <img  src="{{ url('/images/icons/icon256x256.png') }}" class="img-responsive">
                    </div>
                  </div>
                
               
              <div class="box-footer">
                <button type="submit" class="pull-left btn btn-md col-md-2 btn-flat btn-primary">
                    {{ __('adminstaticword.Save') }} 
                  </button>
                  
              </div>
              </form>
        </div>
        <!-- /.box-body -->
     
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>