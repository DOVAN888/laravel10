<div class="overflow">
@include('backend.dashboad.component.breadcrumb', ['title' => $config['seo']['create']['title']])

<?php
$url = ($config['method'] == 'create') ? route('user.catalogue.store') : route('user.catalogue.update',$userCatalogue->id);
?>
<form action="{{$url}}" method="post" class="box">
	@csrf
	<div class="wrapper wrapper-content animated fadeInRight">


		<!-- hang1... -->
	<div class="row">

			<div class="col-lg-5">
				<div class="panel-head">

					<div class="panel-title">thong tin chung</div>
					<div class="panel-description">nhap thong tin chung cua nhom thanh vien </div>
					<p>Luu y :nhung truong danh dau <span class="text-danger">(*)</span> la bat buoc</p>
					
				      </div>
				
			</div>
			<div class="col-lg-7">

				<div class="ibox">
					<div class="ibox-title">
						@include('alert')
						<h5>thong tin chung </h5>
					</div>

					<div class="ibox-content">
						<div class="row mb15">
							<div class="col-lg-6">
								<div class="form-row">
									<label for="" class="control-lable text-right">
										Ten nhom 
									<span class="text-danger">(*)</span>
									</label>

									<input 
									type="text" 
									name="name"
									value="{{old('name',($userCatalogue->name ) ?? '')}}"
									class="form-control"
									placeholder=""
									autocomplete="off" 
									>
									
								</div>
								
							</div>
								<div class="col-lg-6">
								<div class="form-row">
									<label for="" class="control-lable text-right">
										ghi chu 
									
									</label>

									<input 
									type="text" 
									name="description"
									value="{{old('description',($userCatalogue->description) ?? '')}}"
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
