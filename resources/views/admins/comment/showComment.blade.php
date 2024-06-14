@extends('homeA')
@section('adminContent')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Bình luận chờ phản hồi
        </div>
        <?php

        use Illuminate\Support\Facades\Session;

        $mess = Session::get('message');
        if ($mess) {
            echo '<div class="alert-t alert-success" style="margin-top:10px;">' . $mess . '</div>';
            Session::put('message', null);
        }
        ?>
        <div class="status-order" style="margin: 20px 1em;">
            <a href="{{URL::to('/admin/show-comment/waiting')}}" class="<?php echo $retVal = ($status == 'waiting') ? 'active' : 'b'; ?> waiting">Chờ phê duyệt</a>
            <a href="{{URL::to('/admin/show-comment/all')}}" class="<?php echo $retVal = ($status == 'all') ? 'active' : 'b'; ?> all">Tất cả</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="tableComment">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Mã</th>
                        <th>Thông tin</th>
                        <th>Nội dung</th>
                        <th style="width:230px;">Trạng thái</th>
                        @hasrole(['Admin', 'Author'])
                        <th style="width:30px;">Xóa</th>
                        @endhasrole
                    </tr>
                </thead>
                <tbody>
                    @foreach($comment as $cm)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{ $cm->id_comment }}</td>

                        <td>
                            <p><b>Tên: </b> {{$cm->name_comment}}</p>
                            <p><b>Email: </b> {{$cm->email_comment}}</p>
                            <p><b>Sản phẩm: </b> {{$cm->id_product}}</p>
                            <p><b>Ngày gửi: </b> {{$cm->created_at}}</p>
                        </td>
                        <td>{{ $cm->content_comment}}</td>
                        <td class="text-primary">
                            <form action="{{URL::to('/admin/update-comment/'.$cm->id_comment)}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <select class="form-control m-bot15" name="status_comment">
                                        @if ($cm->status_comment == 0)
                                        <option selected value="0">Hiển thị</option>
                                        <option value="1">Chờ phê duyệt</option>
                                        <option value="2">Không được hiển thị</option>
                                        @elseif($cm->status_comment == 1)
                                        <option value="0">Hiển thị</option>
                                        <option selected value="1">Chờ phê duyệt</option>
                                        <option value="2">Không được hiển thị</option>
                                        @elseif($cm->status_comment == 2)
                                        <option value="0">Hiển thị</option>
                                        <option value="1">Chờ phê duyệt</option>
                                        <option selected value="2">Không được hiển thị</option>
                                        @endif
                                    </select>
                                </div>
                                <input type="hidden" name="title_slug" value="{{$status}}" required>
                                <button type="submit" class="btn btn-warning update-status-comment" name="update_status_comment">Sửa</button>
                                <a href="#box_detail_comment" data-toggle="modal" data-id="{{$cm->id_comment}}" class="detail-comment btn btn-primary">Chi tiết</a>;
                            </form>
                        </td>
                        @hasrole(['Admin', 'Author'])
                        <td>
                            <a onclick="return confirm('Bạn muốn XÓA Bình luận này? Hành động này sẽ không được hoàn tác.')" href="{{ URL::to('/admin/del-comment/'.$cm->id_comment) }}">
                                <span class="glyphicon glyphicon-trash icon-trash"></span>
                            </a>
                        </td>
                        @endhasrole
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- #box-detail-comment (Hiện chi tiết bình luận) -->
        <div class="modal fade" id="box_detail_comment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Chi tiết Bình Luận</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body-detail-comment">
                            <div class="info-comment">
                                <ul class="list-group" style="margin-bottom: 20px;">
                                    <li class="list-group-item"><b>Người gửi bình luận: </b> <span id="info_name_comment"></span></li>
                                    <li class="list-group-item"><b>Email: </b> <span id="info_email_comment"></span></li>
                                    <li class="list-group-item"><b>Có tài khoản khách: </b> <span id="info_client_comment"></span></li>
                                    <li class="list-group-item"><b>Sản phẩm được bình luận: </b> <span id="info_product_comment"></span></li>
                                    <li class="list-group-item"><b>Trạng thái bình luận: </b> <span id="info_status_comment"></span></li>
                                    <li class="list-group-item"><b>Admin duyệt lần cuối: </b> <span id="info_admin_comment"></span></li>
                                    <li class="list-group-item"><b>Ngày gửi: </b> <span id="info_created_comment"></span></li>
                                </ul>
                            </div>
                            <div>
                                <div id="info_content_comment"></div>
                                <div id="info_rep_comment"></div>
                            </div>
                            <div class="rep-comment" id="info_admin_rep_comment"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- //box-detail-comment -->

    </div>
</div>
@endsection