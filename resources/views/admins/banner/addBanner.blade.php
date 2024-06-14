@extends('homeA')
@section('adminContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Banner
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
                    ?>
                    <form role="form" action="{{ URL::to('/admin/add-banner') }}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name-banner">Tên banner</label>
                            <input type="text" name="name_banner" class="form-control" id="name-banner" placeholder="Tên slider" required>
                        </div>
                        <div class="form-group">
                            <label for="description-banner">Mô tả Banner</label>
                            <textarea class="form-control " id="description-banner" name="description_banner" style="resize: vertical;" placeholder="Mô tả banner"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Ảnh Banner</label>
                            <input type="file" id="exampleInputFile" name="img_banner">
                            <p class="help-block">Example block-level help text here.</p>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess">Trạng thái</label>
                            <select class="form-control m-bot15" name="status_banner">
                                <option value="0">Hoạt động</option>
                                <option value="1">Dừng hoạt động</option>
                            </select>
                        </div>
                        <button type="submit" name="add_banner" class="btn btn-info">Thêm</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection