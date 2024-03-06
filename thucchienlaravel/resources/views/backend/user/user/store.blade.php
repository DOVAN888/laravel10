<div class="overflow">
@include('backend.dashboad.component.breadcrumb', ['title' => $config['seo']['create']['title']])

<?php
$url = ($config['method'] == 'create') ? route('user.store') : route('user.update',$user->id);
?>
<form action="{{$url}}" method="post" class="box">
	@csrf
	<div class="wrapper wrapper-content animated fadeInRight">


		<!-- hang1... -->
	<div class="row">

			<div class="col-lg-5">
				<div class="panel-head">

					<div class="panel-title">thong tin chung</div>
					<div class="panel-description">nhap thong tin chung cua nguoi</div>
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
										Email
									<span class="text-danger">(*)</span>
									</label>

									<input 
									type="text" 
									name="email"
									value="{{old('email',($user->email) ?? '')}}"
									class="form-control"
									placeholder=""
									autocomplete="off" 
									>
									
								</div>
								
							</div>
								<div class="col-lg-6">
								<div class="form-row">
									<label for="" class="control-lable text-right">
										Ho Ten 
									<span class="text-danger">(*)</span>
									</label>

									<input 
									type="text" 
									name="name"
									value="{{old('name',($user->name) ?? '')}}"
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
								            Nhom thanh vien 
								        </label>

								        <select name="user_catalogue_id" class="form-control setupSelect2">
								            @foreach($userCatalogues as $userCatalogue)
								                <option value="{{ $userCatalogue->id }}" {{ old('user_catalogue_id', isset($user->user_catalogue_id) && $user->user_catalogue_id == $userCatalogue->id ? 'selected' : '') }}>
								                    {{ $userCatalogue->name }}
								                </option>
								            @endforeach
								        </select>
								    </div>
								</div>


									
							

								<div class="col-lg-6">
								<div class="form-row">
									<label for="" class="control-lable text-left">
										Ngay sinh 
									</label>

									<input 
										    type="date" 
										    name="birthday"
										    value="{{ old('birthday', isset($user->birthday) ? date('Y-m-d', strtotime($user->birthday)) : '') }}"
										    class="form-control"
										    placeholder=""
										    autocomplete="off" 
										>

								</div>
								
							</div>
						</div>
						@if($config['method']=='create')


						<div class="row mb15">
							<div class="col-lg-6">
								<div class="form-row">
									<label for="" class="control-lable text-left">
									Mat khau 
									<span class="text-danger">(*)</span>
									</label>

									<input 
									type="password" 
									name="password"
									value=""
									class="form-control"
									placeholder=""
									autocomplete="off" 
									>
									
								</div>
								
							</div>
								<div class="col-lg-6">
								<div class="form-row">
									<label for="" class="control-lable text-left">
								    nhap lai mat khau 
									<span class="text-danger">(*)</span>
									</label>

									<input 
									type="password" 
									name="re_password"
									value=""
									class="form-control"
									placeholder=""
									autocomplete="off" 
									>
									
								</div>
					</div>
				</div>

				@endif



						<div class="row mb15">
							<div class="col-lg-12">
								<div class="form-row">
									<label for="" class="control-lable text-left">
									Anh Dai Dien 
									<span class="text-danger">(*)</span>
									</label>

									<input 
									type="text" 
									name="image"
									value="{{old('image',($user->image) ?? '')}}"
									class="form-control upload-image"
									data-upload="Images"
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


	</div>

	<hr>

	<!-- hang2..... -->

	<div class="row">
			<div class="col-lg-5">
				<div class="panel-head">
					<div class="panel-title">thong tin Lien he</div>
					<div class="panel-description">nhap thong tin lien he cua nguoi su dung </div>
					<p>Luu y nhung truong danh dau	<span class="text-danger">(*)</span>la bat buoc</p>
					
				      </div>
				
			</div>
			<div class="col-lg-7">

				<div class="ibox">
					<div class="box-title">
						<h5>thong tin chung </h5>
					</div>
					<div class="ibox-content">

						<!-- hang1.. -->
						<div class="row mb15">
							<div class="col-lg-6">
								<div class="form-row">
									<label for="" class="control-lable text-right">
									Thanh Pho 
									</label>
									<select name="province_id" class="form-control setupSelect2 province location" data-target="districts">

								    <option value="0">[Chọn thành phố]</option>
								    @isset($provinces)
								        @foreach($provinces as $province)
								            <option {{ old('province_id') == $province->code ? 'selected' : '' }} value="{{ $province->code }}">{{ $province->name }}</option>
								        @endforeach
								    @endisset
								</select>


									
									
								</div>
								
							</div>

							<div class="col-lg-6">
								<div class="form-row">
									<label for="" class="control-lable text-right">
								    Quan/Huyen
									</label>
									<select name="district_id" class="form-control setupSelect2 districts location" data-target="wards">
										<option value="0">[Quan/Huyen]</option>
										
									</select>

									
									
								</div>
								
							</div>
				
			</div>
			<!-- hang2... -->
			<div class="row mb15">
							<div class="col-lg-6">
								<div class="form-row">
									<label for="" class="control-lable text-right">
									phuong /xa
									</label>
									<select name="ward_id" class="form-control setupSelect2 location wards"data-target>
										<option value="0">[chon phuong /xa]</option>
										
									</select>

									
									
								</div>
								
							</div>

						<div class="col-lg-6">
								<div class="form-row">
									<label for="" class="control-lable text-left">
									Dia chi
									</label>

									<input 
									type="text" 
									name="address"
									value="{{old('address',($user->address) ?? '')}}"
									class="form-control"
									placeholder=""
									autocomplete="off" 
									>
									
								</div>
								
							</div>


								
							
					
				
				
			</div>


			<!-- hang3....... -->

						<div class="row mb15">
							<div class="col-lg-6">
								<div class="form-row">
									<label for="" class="control-lable text-left">
								so dien thoai
									
									</label>

									<input 
									type="text" 
									name="phone"
									value="{{old('phone',($user->phone) ?? '')}}"
									class="form-control"
									placeholder=""
									autocomplete="off" 
									>
									
								</div>
								
							</div>
								<div class="col-lg-6">
								<div class="form-row">
									<label for="" class="control-lable text-left">
							Ghi chu
									
									</label>

									<input 
									type="text" 
									name="description"
									value="{{old('description',($user->description) ?? '')}}"
									class="form-control"
									placeholder=""
									autocomplete="off" 
									>
									
								</div>
					</div>


	</div>

	<div class="text-right mb15">
		
		<button class="btn btn-primary" type="submit" name="send" value="send">Luu lai </button>
	</div>

</div>
</div>

</form>
</div>


<!-- xu ly thang thanh pho quan huyen abang javascript -->
<script type="text/javascript">
	var province_id = '{{ isset($user->province_id) ? $user->province_id : old('province_id') }}';
  var district_id = '{{ isset($user->district_id) ? $user->district_id : old('district_id') }}';
   var ward_id = '{{ isset($user->ward_id) ? $user->ward_id : old('ward_id') }}';




</script>