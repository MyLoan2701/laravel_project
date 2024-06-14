@extends('homeA')
@section('adminContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Quyền truy cập
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <?php

                    use Illuminate\Support\Facades\Session;

                    $mess = Session::get('message');
                    if ($mess) {
                        echo '<div class="alert-t alert-success">' . $mess . '</div>';
                        Session::put('message', null);
                    }
                    $warn = Session::get('warning');
                    if ($warn) {
                        echo '<div class="alert-t alert-danger">' . $warn . '</div>';
                        Session::put('warning', null);
                    }
                    ?>
                    <form role="form" action="{{ URL::to('/admin/add-role') }}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name-role">Tên Quyền truy cập</label>
                            <input type="text" name="name_role" class="form-control" id="name-role" placeholder="Tên Quyền truy cập" required>
                        </div>
                        <div class="form-group">
                            <label for="description-role">Mô tả Quyền truy cập</label>
                            <textarea class="form-control " id="description-role" name="description_role" 
                            style="resize: vertical;"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess">Trạng thái</label>
                            <select class="form-control m-bot15" name="status_role">
                                <option value="0">Hoạt động</option>
                                <option value="1">Dừng hoạt động</option>
                            </select>
                        </div>
                        <button type="submit" name="add_role" class="btn btn-info">Thêm</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection