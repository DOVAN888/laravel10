
@include('backend.dashboad.component.breadcrumb',['title'=>$config['seo']['index']['title']])

  <div class="row mt20">
              
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{$config['seo']['index']['table']}} </h5>
                   @include('backend.user.user.component.toolbox')

                    </div>

                      <div class="ibox-content">


                        @include('backend.user.user.component.filter')
            


                     @include('backend.user.user.component.table')
                </div>
            </div>
            </div>
          <!--  <script>
    $(document).ready(function(){
        var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, { color: '#1AB394' });
    });
</script> -->

          
        </div>
    </div>
    
