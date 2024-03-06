<div class="overflow">
@include('backend.dashboad.component.breadcrumb', ['title' => $config['seo']['create']['title']])

<?php
$url = ($config['method'] == 'create') ? route('language.store') : route('language.update',$languages->id);
?>
<form action="{{$url}}" method="post" class="box">
	@csrf
	<div class="wrapper wrapper-content animated fadeInRight">


		<!-- hang1... -->
	<div class="row">

			<div class="col-lg-5">
				<div class="panel-head">

					<div class="panel-title">thong tin chung</div>
					<div class="panel-description">nhap thong tin ngon ngu </div>
					<p>Luu y :nhung truong danh dau <span class="text-danger">(*)</span> la bat buoc</p>
					
				      </div>
				
			</div>
			<div class="col-lg-7">

				<div class="ibox">
					<div class="ibox-title">
						@include('alert')
						<h5>nhap thong tin ngon ngu  </h5>
					</div>

					<div class="ibox-content">
						<div class="row mb15">
							<div class="col-lg-6">
								<div class="form-row">
									<label for="" class="control-lable text-right">
										Ten ngon ngu
									<span class="text-danger">(*)</span>
									</label>

									<input 
									type="text" 
									name="name"
									value="{{old('name',($languages->name ) ?? '')}}"
									class="form-control"
									placeholder=""
									autocomplete="off" 
									>
									
								</div>
								
							</div>
								<div class="col-lg-6">
								<div class="form-row">
									<label for="" class="control-lable text-right">
									Canonical
									<span class="text-danger">(*)</span>
									
									</label>

									<input 
									type="text" 
									name="canonical"
									value="{{old('canonical',($languages->canonical) ?? '')}}"
									class="form-control"
									placeholder=""
									autocomplete="off" 
									>
									
								</div>
								
							</div>
							
						</div>
							

								<div class="row mb15">
							<div class="col-lg-6">
								<div class="form-row">
									<label for="" class="control-lable text-right">
										anh dai dien 
									
									</label>

									<input 
									type="text" 
									name="image"
									value="{{old('image',($languages->image ) ?? '')}}"
									class="form-control upload-image"
									 data-type="Images"
									placeholder=""
									autocomplete="off" 
									>
									
								</div>
								
							</div>
								<div class="col-lg-6">
								<div class="form-row">
									<label for="" class="control-lable text-right">
									Ghi chu
									
									</label>

									<input 
									type="text" 
									name="description"
									value="{{old('description',($languages->description) ?? '')}}"
									class="form-control"
									placeholder=""
									autocomplete="off" 
									>
									
								</div>
								
							</div>
							
						</div>
									
								</div>
								
							</div>


								
							
							</div>
			


				
			</div>




	

	<!-- hang2..... -->


	<div class="text-right mb15">
		
		<button class="btn btn-primary" type="submit" name="send" value="send">Luu lai </button>
	</div>

</div>
</div>

</form>
</div>


<!-- xu ly thang thanh pho quan huyen abang javascript -->
