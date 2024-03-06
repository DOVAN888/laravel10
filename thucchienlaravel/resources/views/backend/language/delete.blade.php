<div class="overflow">
    @include('backend.dashboad.component.breadcrumb', ['title' => $config['seo']['delete']['title']])

    <form action="{{route('language.destroy',$languages->id)}}" method="post" class="box">
        @csrf
        @method('DELETE')

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-5">
                    <div class="panel-head">
                        <div class="panel-title">thong tin chung</div>
                        <div class="panel-description">ban dang muon xoa nhom thanh vien co ten la  la:「{{$languages->name }}」</div>
                        <p>Luu y: khong the khoi phuc thnah vien sau khi xoa, hay chac chan muon thuc hien chuc nang nay </p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="ibox">
                        <div class="ibox-title">
                            @include('alert')
                            <h5>thong tin chung</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row mb15" style="text-right:center;">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-right">
                                            name 
                                            <span class="text-danger">(*)</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            name="name "
                                            value="{{ old('name ', ($languages->name ?? '') ) }}"
                                            class="form-control"
                                            placeholder=""
                                            autocomplete="off"
                                            readonly 
                                        >

                                       
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="text-right mb15">
                <button class="btn btn-danger" type="submit" name="send" value="send">XOA</button>
            </div>
        </div>
    </form>
</div>
