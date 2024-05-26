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

<form action="{{route('user.destroy',$user->id)}}" method="post" class="box">
    @csrf
    @method('DELETE')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p>Bạn đang muốn xóa thành viên có email là: {{$user->email}}</p>
                        <p>Lưu ý: Không thể khôi phục thành viên sau khi xóa. Hãy chắc chắn bạn muốn thực hiện chức năng này</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="inbox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="email" class="control-label text-right">Email <span
                                            class="text-danger">(*)</span></label>
                                    <input type="text" id="email" name="email"
                                        value="{{ old('email', $user->email ?? '') }}" class="form-control"
                                        autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="name" class="control-label text-right">Họ tên<span
                                            class="text-danger">(*)</span></label>
                                    <input type="text" id="name" name="name"
                                        value="{{ old('name', $user->name ?? '') }}" class="form-control"
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
