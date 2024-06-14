@include('backend.dashboard.component.breadcrumb', [
    'title' => $config['seo']['delete']['title'],
])

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{route('user.catalogue.destroy',$userCatalogues->id)}}" method="post" class="box">
    @csrf
    @method('DELETE')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p>Bạn đang muốn xóa nhóm thành viên có tên là: <span class="text-danger">{{$userCatalogues->name}}</span></p>
                        <p>Lưu ý: Không thể khôi phục nhóm thành viên sau khi xóa. Hãy chắc chắn bạn muốn thực hiện chức năng này</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="inbox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="name" class="control-label text-right">Tên nhóm<span
                                            class="text-danger">(*)</span></label>
                                    <input type="text" id="name" name="name"
                                        value="{{ old('name', $userCatalogues->name ?? '') }}" class="form-control"
                                        autocomplete="off" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="text-right mt20">
            <button class="btn btn-danger" type="submit" name="send" value="send">Xóa dữ liệu</button>
        </div>
    </div>
</form>
